document.addEventListener('DOMContentLoaded', function() {
    fetch('http://localhost/code/_api/api.php?action=getTopScores')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            const scoresTableBody = document.querySelector('#scoresTable tbody');
            scoresTableBody.innerHTML = '';
            data.forEach((score, index) => {
                const row = document.createElement('tr');
                
                if (index === 0) {
                    row.classList.add('gold');
                } else if (index === 1) {
                    row.classList.add('silver');
                } else if (index === 2) {
                    row.classList.add('bronze');
                }
                
                const nameCell = document.createElement('td');
                const scoreCell = document.createElement('td');
                nameCell.textContent = score.name;
                scoreCell.textContent = parseFloat(score.normalized_score).toFixed(2);
                row.appendChild(nameCell);
                row.appendChild(scoreCell);
                scoresTableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching scores:', error));
});
