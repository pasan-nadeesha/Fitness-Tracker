document.addEventListener('DOMContentLoaded', function () {
    // HTML Data Holder එකෙන් Backend Data කියවා ගැනීම
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

    // 1. Line Chart Setup (Database History සම්බන්ධ කර ඇත)
    const ctxLineEl = document.getElementById('caloriesChart');
    if (ctxLineEl) {
        const ctxLine = ctxLineEl.getContext('2d');
        const chartLabels = chartHistory.labels && chartHistory.labels.length > 0 ? chartHistory.labels : ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan'];
        const chartData = chartHistory.data && chartHistory.data.length > 0 ? chartHistory.data : [2200, 2500, 2100, 2700, 2400, 2650, 2800];

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
                        max: 3000,
                        ticks: { stepSize: 750, color: '#9ca3af', font: { size: 11 } },
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

    // Live changes සඳහා event listeners attach කිරීම
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
        let waterValue = parseFloat(document.getElementById('water-input')?.value) || 0;
        let hydrationEl = document.getElementById('hydration-display');
        if (hydrationEl) hydrationEl.innerText = waterValue + 'L';

        let run = parseInt(document.getElementById('run-input')?.value) || 0;
        let cycle = parseInt(document.getElementById('cycle-input')?.value) || 0;
        let weight = parseInt(document.getElementById('weight-input')?.value) || 0;
        let swim = parseInt(document.getElementById('swim-input')?.value) || 0;

        let totalMinutes = run + cycle + weight + swim;
        let hours = Math.floor(totalMinutes / 60);
        let mins = totalMinutes % 60;
        let timeString = (hours > 0) ? `${hours}h ${mins}m` : `${mins}m`;

        let workoutEl = document.getElementById('workout-display');
        if (workoutEl) workoutEl.innerText = totalMinutes > 0 ? timeString : "0m";

        let workoutBurn = (run * 10) + (cycle * 8) + (weight * 6) + (swim * 9);
        let totalCalories = 2000 + workoutBurn;
        let calsEl = document.getElementById('calories-display');
        if (calsEl) calsEl.innerText = totalCalories.toLocaleString();

        let bodyWeight = parseFloat(document.getElementById('body-weight')?.value) || 0;
        let bodyHeight = parseFloat(document.getElementById('body-height')?.value) || 0;

        if (bodyWeight > 0 && bodyHeight > 0) {
            let heightMeters = bodyHeight / 100;
            let bmi = (bodyWeight / (heightMeters * heightMeters)).toFixed(1);
            let category = (bmi < 18.5) ? "Underweight" : ((bmi < 25) ? "Normal weight" : ((bmi < 30) ? "Overweight" : "Obese"));

            let bmiEl = document.getElementById('bmi-display');
            let bmiStatEl = document.getElementById('bmi-status');
            if (bmiEl) bmiEl.innerText = bmi;
            if (bmiStatEl) bmiStatEl.innerText = category;
        }

        // Daily Rings & Progress Bars Calculations
        let pctMove = Math.min(Math.round((totalCalories / 2500) * 100), 100);
        let pctExercise = Math.min(Math.round((totalMinutes / 60) * 100), 100);
        let pctWater = Math.min(Math.round((waterValue / 2.5) * 100), 100);
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
        if (moveSub) moveSub.innerText = `${totalCalories.toLocaleString()} / 2,500 kcal`;

        let exPctText = document.getElementById('exercise-pct-text');
        let exBar = document.getElementById('exercise-bar');
        let exSub = document.getElementById('exercise-subtext');
        if (exPctText) exPctText.innerText = pctExercise + "%";
        if (exBar) exBar.style.width = pctExercise + "%";
        if (exSub) exSub.innerText = `${totalMinutes} / 60 min`;

        let wPctText = document.getElementById('water-pct-text');
        let wBar = document.getElementById('water-bar');
        let wSub = document.getElementById('water-subtext');
        if (wPctText) wPctText.innerText = pctWater + "%";
        if (wBar) wBar.style.width = pctWater + "%";
        if (wSub) wSub.innerText = `${waterValue} / 2.5 L`;
    }
});