document.addEventListener('DOMContentLoaded', function () {
    const dataHolder = document.getElementById('rings-data-holder');
    let chartHistory = { labels: [], data: [] };
    let initWater = 0, initEx = 0, initMove = 0, initAvg = 0;

    if (dataHolder) {
        try {
            chartHistory = JSON.parse(dataHolder.getAttribute('data-chart')) || { labels: [], data: [] };
        } catch (e) {
            chartHistory = { labels: [], data: [] };
        }
        initWater = parseInt(dataHolder.getAttribute('data-water')) || 0;
        initEx = parseInt(dataHolder.getAttribute('data-exercise')) || 0;
        initMove = parseInt(dataHolder.getAttribute('data-move')) || 0;
        initAvg = parseInt(dataHolder.getAttribute('data-avg')) || 0;
    }

    // 1. Line Chart Setup
    const ctxLineEl = document.getElementById('caloriesChart');
    if (ctxLineEl) {
        const ctxLine = ctxLineEl.getContext('2d');
        const chartLabels = chartHistory.labels && chartHistory.labels.length > 0 ? chartHistory.labels : ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan'];
        const chartData = chartHistory.data && chartHistory.data.length > 0 ? chartHistory.data : [0, 0, 0, 0, 0, 0, 0];

        let gradientBlue = ctxLine.createLinearGradient(0, 0, 0, 300);
        gradientBlue.addColorStop(0, 'rgba(59, 130, 246, 0.15)');
        gradientBlue.addColorStop(1, 'rgba(59, 130, 246, 0)');

        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [
                    {
                        label: 'Burned',
                        data: chartData,
                        borderColor: '#3b82f6',
                        backgroundColor: gradientBlue,
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#10b981',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'white',
                        titleColor: '#111827',
                        bodyColor: '#111827',
                        borderColor: '#e5e7eb',
                        borderWidth: 1,
                        padding: 10,
                        displayColors: false,
                        callbacks: {
                            label: function (context) {
                                return `Burned : ${context.parsed.y} kcal`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 200, color: '#9ca3af', font: { size: 11 } },
                        border: { display: false },
                        grid: { color: '#f3f4f6' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#9ca3af', font: { size: 11 } },
                        border: { display: false }
                    }
                }
            }
        });
    }

    // 2. Ring Chart Setup (Daily Rings)
    const ctxDoughnutEl = document.getElementById('ringsChart');
    let ringsChart = null;
    if (ctxDoughnutEl) {
        const ctxDoughnut = ctxDoughnutEl.getContext('2d');
        ringsChart = new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                datasets: [
                    { 
                        // Outer Ring: Hydration (Blue)
                        data: [initWater, Math.max(0, 100 - initWater)], 
                        backgroundColor: ['#3b82f6', '#f3f4f6'], 
                        borderWidth: 0, 
                        weight: 1 
                    },
                    { 
                        // Middle Ring: Exercise (Green)
                        data: [initEx, Math.max(0, 100 - initEx)], 
                        backgroundColor: ['#10b981', '#f3f4f6'], 
                        borderWidth: 0, 
                        weight: 1 
                    },
                    { 
                        // Inner Ring: Move (Purple)
                        data: [initMove, Math.max(0, 100 - initMove)], 
                        backgroundColor: ['#8b5cf6', '#f3f4f6'], 
                        borderWidth: 0, 
                        weight: 1 
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                }
            }
        });
    }

    // Input IDs for Real-time Event Listeners
    const inputIds = [
        'water-input', 
        'run-input', 
        'cycle-input', 
        'weight-input', 
        'swim-input', 
        'body-weight', 
        'body-height'
    ];

    inputIds.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener('input', updateDashboardUI);
        }
    });

    // Initial Load UI Update
    updateDashboardUI();

    // Calculate & Live Update Function
    function updateDashboardUI() {
        // 1. Saved Cumulative Totals from HTML
        let workoutEl = document.getElementById('workout-display');
        let calsEl = document.getElementById('calories-display');
        let hydrationEl = document.getElementById('hydration-display');

        let savedMins = parseInt(workoutEl?.getAttribute('data-saved-mins')) || 0;
        let savedCals = parseInt(calsEl?.getAttribute('data-saved-cals')) || 0;
        let savedWater = parseFloat(hydrationEl?.getAttribute('data-saved-water')) || 0.0;

        // 2. Current Session Inputs
        let inputWater = parseFloat(document.getElementById('water-input')?.value) || 0.0;
        let run = parseInt(document.getElementById('run-input')?.value) || 0;
        let cycle = parseInt(document.getElementById('cycle-input')?.value) || 0;
        let weight = parseInt(document.getElementById('weight-input')?.value) || 0;
        let swim = parseInt(document.getElementById('swim-input')?.value) || 0;

        let currentInputMins = run + cycle + weight + swim;
        let currentInputCals = (run * 10) + (cycle * 8) + (weight * 6) + (swim * 9);

        // 3. Grand Totals for Today
        let totalMins = savedMins + currentInputMins;
        let totalCals = savedCals + currentInputCals;
        let totalWater = savedWater + inputWater;

        // 4. Update Cards
        if (workoutEl) {
            let h = Math.floor(totalMins / 60);
            let m = totalMins % 60;
            workoutEl.innerText = (totalMins > 0) ? ((h > 0 ? `${h}h ` : '') + `${m}m`) : '0m';
        }

        if (calsEl) {
            calsEl.innerText = totalCals.toLocaleString();
        }

        if (hydrationEl) {
            hydrationEl.innerText = `${totalWater.toFixed(1)}L`;
        }

        // 5. BMI Calculation
        let bodyWeight = parseFloat(document.getElementById('body-weight')?.value) || 0;
        let bodyHeight = parseFloat(document.getElementById('body-height')?.value) || 0;
        let bmiEl = document.getElementById('bmi-display');
        let bmiStatEl = document.getElementById('bmi-status');

        if (bodyWeight > 0 && bodyHeight > 0) {
            let heightMeters = bodyHeight / 100;
            let bmi = (bodyWeight / (heightMeters * heightMeters)).toFixed(1);
            let category = (bmi < 18.5) ? "Underweight" : ((bmi < 25) ? "Normal weight" : ((bmi < 30) ? "Overweight" : "Obese"));
            if (bmiEl) bmiEl.innerText = bmi;
            if (bmiStatEl) bmiStatEl.innerText = category;
        }

        // 6. Rings & Progress Bars Calculations
        let pctMove = Math.min(Math.round((totalCals / 500) * 100), 100);
        let pctExercise = Math.min(Math.round((totalMins / 60) * 100), 100);
        let pctWater = Math.min(Math.round((totalWater / 2.5) * 100), 100);
        let avgPct = Math.round((pctMove + pctExercise + pctWater) / 3);

        // Update Rings Chart Datasets
        if (ringsChart) {
            ringsChart.data.datasets[0].data = [pctWater, Math.max(0, 100 - pctWater)];
            ringsChart.data.datasets[1].data = [pctExercise, Math.max(0, 100 - pctExercise)];
            ringsChart.data.datasets[2].data = [pctMove, Math.max(0, 100 - pctMove)];
            ringsChart.update();
        }

        // Update Text & Progress Bars
        let ringCenter = document.getElementById('ring-center');
        if (ringCenter) ringCenter.innerText = avgPct + "%";

        let movePctText = document.getElementById('move-pct-text');
        let moveBar = document.getElementById('move-bar');
        let moveSub = document.getElementById('move-subtext');
        if (movePctText) movePctText.innerText = pctMove + "%";
        if (moveBar) moveBar.style.width = pctMove + "%";
        if (moveSub) moveSub.innerText = `${totalCals.toLocaleString()} / 500 kcal`;

        let exPctText = document.getElementById('exercise-pct-text');
        let exBar = document.getElementById('exercise-bar');
        let exSub = document.getElementById('exercise-subtext');
        if (exPctText) exPctText.innerText = pctExercise + "%";
        if (exBar) exBar.style.width = pctExercise + "%";
        if (exSub) exSub.innerText = `${totalMins} / 60 min`;

        let wPctText = document.getElementById('water-pct-text');
        let wBar = document.getElementById('water-bar');
        let wSub = document.getElementById('water-subtext');
        if (wPctText) wPctText.innerText = pctWater + "%";
        if (wBar) wBar.style.width = pctWater + "%";
        if (wSub) wSub.innerText = `${totalWater.toFixed(1)} / 2.5 L`;
    }
});