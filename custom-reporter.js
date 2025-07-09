import fs from 'fs';

class CustomReporter {
    constructor() {
        this.testResults = [];
    }

    onTestEnd(test, result) {
        const section = test.parent?.title || 'อื่นๆ';
        const steps = result.steps.map(step => step.title).join(' → ');
        // ดึง error message ถ้ามี
        let errorMessage = '';
        if (result.errors && result.errors.length > 0) {
            errorMessage = result.errors.map(e => e.message).join('\n');
        } else if (result.error) {
            errorMessage = result.error.message;
        }
        this.testResults.push({
            section,
            name: test.title,
            steps,
            status: result.status,
            duration: (result.duration / 1000).toFixed(2) + 's',
            error: errorMessage,
        });
    }

    generateHTMLReport() {
        // --- จัดกลุ่มตาม section ---
        const sections = {};
        this.testResults.forEach(test => {
            if (!sections[test.section]) sections[test.section] = [];
            sections[test.section].push(test);
        });

        // --- สรุปตาราง ---
        let testsSummary = '';
        Object.keys(sections).forEach(section => {
            testsSummary += `<tr><th colspan="6" style="background:#e0e0ff;text-align:left;">${section}</th></tr>`;
            sections[section].forEach((test, idx) => {
                testsSummary += `
<tr>
  <td>${idx + 1}</td>
  <td>${test.name}</td>
  <td>${test.steps}</td>
  <td>${test.status.charAt(0).toUpperCase() + test.status.slice(1)}</td>
  <td>${test.duration}</td>
  <td style="color:#d32f2f;">${test.error ? test.error.replace(/\n/g, '<br>') : ''}</td>
</tr>
`;
            });
        });

        // --- donut chart รวม ---
        const passed = this.testResults.filter(test => test.status === 'passed').length;
        const failed = this.testResults.filter(test => test.status === 'failed').length;
        const skipped = this.testResults.filter(test => test.status === 'skipped').length;
        const total = passed + failed + skipped;

        const htmlContent = `
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Playwright Test Report</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; background-color: #f9f9f9; }
    .header-container { text-align: center; color: #333; padding: 10px; margin-bottom: 20px; }
    .chart-container { width: 100%; display: flex; justify-content: center; align-items: center; margin-bottom: 10px; }
    .table-container { width: 100%; margin-top: 20px; }
    table { width: 100%; border-collapse: collapse; background-color: #fff; border-radius: 8px; overflow: hidden; }
    table, th, td { border: 1px solid #ddd; padding: 8px; }
    th { background-color: #f2f2f2; text-align: left; }
    tr:nth-child(even) { background-color: #f9f9f9; }
    tr:hover { background-color: #f1f1f1; }
  </style>
</head>
<body>
  <div class="header-container">
    <h1>Test Results Summary</h1>
    <p>Total Tests: ${total} | Passed: ${passed} | Failed: ${failed} | Skipped: ${skipped}</p>
    <div class="chart-container">
      <canvas id="donutChart" width="200" height="200"></canvas>
    </div>
  </div>
  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>S.No</th>
          <th>Test Name</th>
          <th>Steps</th>
          <th>Status</th>
          <th>Time Taken</th>
          <th>Error</th>
        </tr>
      </thead>
      <tbody>
        ${testsSummary}
      </tbody>
    </table>
  </div>
  <script>
    new Chart(document.getElementById('donutChart').getContext('2d'), {
      type: 'doughnut',
      data: {
        labels: ['Passed', 'Failed', 'Skipped'],
        datasets: [{
          data: [${passed}, ${failed}, ${skipped}],
          backgroundColor: ['#4CAF50', '#F44336', '#FFC107'],
          hoverOffset: 4
        }]
      },
      options: {responsive: false, maintainAspectRatio: false}
    });
  </script>
</body>
</html>
`;

        fs.writeFileSync('test-report.html', htmlContent);
    }

    onEnd() {
        this.generateHTMLReport();
    }
}

export default CustomReporter;
