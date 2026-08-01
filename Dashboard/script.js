//line chart for calories
const ctxLine = document.getElementById('caloriesChart').getContext('2d');




let gradientBlue = ctxLine.createLinearGradient(0, 0, 0, 300);
gradientBlue.addColorStop(0, 'rgba(59, 130, 246, 0.15)');
gradientBlue.addColorStop(1, 'rgba(59, 130, 246, 0)');

new Chart(ctxLine, {
    type: 'line',
    data: {
        labels: ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan'],
        datasets: [
            {
                label: 'Burned',
                data: [2200, 2500, 2100, 2700, 2400, 2650, 2800],
                borderColor: '#3b82f6',
                backgroundColor: gradientBlue,
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#10b981',
                pointRadius: 0,
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
                    label: function(context) {
                        return `Burned : ${context.parsed.y} \nIntake : 2180`; // Hardcoded intake for visual match
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 3000,
                ticks: { stepSize: 750, color: '#9ca3af', font: {size: 11} },
                border: { display: false },
                grid: { color: '#f3f4f6' }
            },
            x: {
                grid: { display: false },
                ticks: { color: '#9ca3af', font: {size: 11} },
                border: { display: false }
            }
        }
    }
});

// ring chart for daily progress
const ctxDoughnut = document.getElementById('ringsChart').getContext('2d');


let ringsChart = new Chart(ctxDoughnut, {
    type: 'doughnut',
    data: {
        datasets: [
            {
                // Outer Ring
                data: [91, 9],
                backgroundColor: ['#3b82f6', '#f3f4f6'],
                borderWidth: 0,
                circumference: 360,
                weight: 1
            },
            {
                // Middle Ring
                data: [67, 33],
                backgroundColor: ['#10b981', '#f3f4f6'],
                borderWidth: 0,
                weight: 1
            },
            {
                // Inner Ring
                data: [82, 18],
                backgroundColor: ['#8b5cf6', '#f3f4f6'],
                borderWidth: 0,
                weight: 1
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '60%', // Creates the empty center
        plugins: {
            legend: { display: false },
            tooltip: { enabled: false }
        }
    }
});



// calc button click event listener
const calcBtn = document.getElementById('calc-btn');

if (calcBtn) {
    calcBtn.addEventListener('click', function() {
        
        //Update Hydration Card
        let waterValue = document.getElementById('water-input').value || 0; 
        document.getElementById('hydration-display').innerText = waterValue + 'L';

        //Calculate Total Workout Time
        let run = parseInt(document.getElementById('run-input').value) || 0;
        let cycle = parseInt(document.getElementById('cycle-input').value) || 0;
        let weight = parseInt(document.getElementById('weight-input').value) || 0;
        let swim = parseInt(document.getElementById('swim-input').value) || 0;

        let totalMinutes = run + cycle + weight + swim;

        let hours = Math.floor(totalMinutes / 60);
        let mins = totalMinutes % 60;

        let timeString = '';
        if (hours > 0) {
            timeString = `${hours}h ${mins}m`;
        } else {
            timeString = `${mins}m`;
        }
        
        if (totalMinutes === 0) {
            timeString = "0m";
        }

        document.getElementById('workout-display').innerText = timeString;

        //Calculate Calories
        let runCals = run * 10;
        let cycleCals = cycle * 8;
        let weightCals = weight * 6;
        let swimCals = swim * 9;

        let workoutBurn = runCals + cycleCals + weightCals + swimCals;
        let baseCalories = 2000;
        let totalCalories = baseCalories + workoutBurn;

        let formattedCalories = totalCalories.toLocaleString();
        document.getElementById('calories-display').innerText = formattedCalories;

        //Calculate BMI
        let bodyWeight = parseFloat(document.getElementById('body-weight').value) || 0;
        let bodyHeight = parseFloat(document.getElementById('body-height').value) || 0;

        if (bodyWeight > 0 && bodyHeight > 0) {
            // Convert cm to meters
            let heightMeters = bodyHeight / 100;
            
            // BMI Formula
            let bmi = bodyWeight / (heightMeters * heightMeters);
            
            // Format to 1 decimal place
            let formattedBMI = bmi.toFixed(1);
            
            // Determine BMI Category
            let category = "";
            if (bmi < 18.5) {
                category = "Underweight";
            } else if (bmi >= 18.5 && bmi < 25) {
                category = "Normal weight";
            } else if (bmi >= 25 && bmi < 30) {
                category = "Overweight";
            } else {
                category = "Obese";
            }

            // Update the HTML Card
            document.getElementById('bmi-display').innerText = formattedBMI;
            document.getElementById('bmi-status').innerText = category;
        } else {
            document.getElementById('bmi-display').innerText = "0.0";
            document.getElementById('bmi-status').innerText = "Enter valid details";
        }
        
        //Update Daily Rings & Progress Bars
        
        let goalCalories = 2500;
        let goalMinutes = 60;
        let goalWater = 2.5;

        //Calculate Percentages
        let pctMove = Math.min(Math.round((totalCalories / goalCalories) * 100), 100);
        let pctExercise = Math.min(Math.round((totalMinutes / goalMinutes) * 100), 100);
        let pctWater = Math.min(Math.round((waterValue / goalWater) * 100), 100);
        
        let avgPct = Math.round((pctMove + pctExercise + pctWater) / 3);

        //Update Chart.js Data
        ringsChart.data.datasets[0].data = [pctWater, 100 - pctWater];       // Outer Ring
        ringsChart.data.datasets[1].data = [pctExercise, 100 - pctExercise]; // Middle Ring
        ringsChart.data.datasets[2].data = [pctMove, 100 - pctMove];         // Inner Ring 
        ringsChart.update(); //Redraws the circle

        //Update HTML Progress Bars and Text Below the chart
        document.getElementById('ring-center').innerText = avgPct + "%";
        
        document.getElementById('move-pct-text').innerText = pctMove + "%";
        document.getElementById('move-bar').style.width = pctMove + "%";
        document.getElementById('move-subtext').innerText = `${formattedCalories} / 2,500 kcal`;

        document.getElementById('exercise-pct-text').innerText = pctExercise + "%";
        document.getElementById('exercise-bar').style.width = pctExercise + "%";
        document.getElementById('exercise-subtext').innerText = `${totalMinutes} / 60 min`;

        document.getElementById('water-pct-text').innerText = pctWater + "%";
        document.getElementById('water-bar').style.width = pctWater + "%";
        document.getElementById('water-subtext').innerText = `${waterValue} / 2.5 L`;

    });
}