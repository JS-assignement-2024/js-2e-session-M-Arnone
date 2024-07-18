document.addEventListener('DOMContentLoaded', function() {
    const userName = localStorage.getItem('userName');
    const userWelcome = document.getElementById('user-welcome');
    userWelcome.textContent = `Bienvenue, ${userName}!`;
});

let selectedOperations = [];
let numberOfExercises = 0;
let exercises = [];

function selectOperation(operation) {
    const button = document.getElementById(`btn-${operation}`);
    const index = selectedOperations.indexOf(operation);
    if (index > -1) {
        selectedOperations.splice(index, 1);
        button.classList.remove('selected');
    } else {
        selectedOperations.push(operation);
        button.classList.add('selected');
    }
}

function generateExercises() {
    numberOfExercises = document.getElementById('num-exercises').value;
    if (selectedOperations.length === 0 || numberOfExercises <= 0) {
        alert("Choisis au moins une opération ;)");
        return;
    }
    exercises = [];
    for (let i = 0; i < numberOfExercises; i++) {
        const operation = selectedOperations[Math.floor(Math.random() * selectedOperations.length)];
        let num1 = Math.floor(Math.random() * 10) + 1;
        let num2 = Math.floor(Math.random() * 10) + 1;
        let exercise;
        let answer;
        switch (operation) {
            case 'addition':
                exercise = `${num1} + ${num2}`;
                answer = num1 + num2;
                break;
            case 'subtraction':
                exercise = `${num1} - ${num2}`;
                answer = num1 - num2;
                break;
            case 'multiplication':
                exercise = `${num1} * ${num2}`;
                answer = num1 * num2;
                break;
            case 'division':
                num1 = num1 * num2; 
                exercise = `${num1} / ${num2}`;
                answer = num1 / num2;
                break;
        }
        exercises.push({operation, num1, num2, exercise, answer});
    }
    displayExercises();
    document.getElementById('submit-button').style.display = 'block';
}

function displayExercises() {
    const container = document.getElementById('drag-drop-container');
    container.innerHTML = '';
    const exerciseContainer = document.createElement('div');
    exerciseContainer.id = 'exercise-container';
    const answerContainer = document.createElement('div');
    answerContainer.id = 'answer-container';

    exercises.forEach((ex, index) => {
        const exerciseDiv = document.createElement('div');
        exerciseDiv.classList.add('exercise');
        exerciseDiv.id = `exercise-${index}`;

        const parts = ['num1', 'num2'];
        const dropPart = parts[Math.floor(Math.random() * parts.length)];

        parts.forEach(part => {
            if (part === dropPart) {
                const dropZone = document.createElement('div');
                dropZone.classList.add('drop-zone');
                dropZone.id = `${part}-${index}`;
                dropZone.ondrop = drop;
                dropZone.ondragover = allowDrop;
                exerciseDiv.appendChild(dropZone);
            } else {
                const staticPart = document.createElement('div');
                staticPart.classList.add('static-part');
                staticPart.innerText = ex[part];
                exerciseDiv.appendChild(staticPart);
            }
        });

        const operatorDiv = document.createElement('div');
        operatorDiv.classList.add('static-part');
        operatorDiv.innerText = getOperatorSymbol(ex.operation);
        exerciseDiv.insertBefore(operatorDiv, exerciseDiv.children[1]);

        const equalsDiv = document.createElement('div');
        equalsDiv.classList.add('static-part');
        equalsDiv.innerText = '=';
        exerciseDiv.appendChild(equalsDiv);

        const answerDiv = document.createElement('div');
        answerDiv.classList.add('static-part');
        answerDiv.innerText = ex.answer;
        exerciseDiv.appendChild(answerDiv);

        exerciseContainer.appendChild(exerciseDiv);

        if (dropPart !== 'answer') {
            const answerDiv = document.createElement('div');
            answerDiv.classList.add('answer');
            answerDiv.id = `answer-${dropPart}-${index}`;
            answerDiv.draggable = true;
            answerDiv.ondragstart = drag;
            answerDiv.innerText = ex[dropPart];
            answerContainer.appendChild(answerDiv);
        }
    });

    container.appendChild(exerciseContainer);
    container.appendChild(answerContainer);
}

function getOperatorSymbol(operation) {
    switch (operation) {
        case 'addition':
            return '+';
        case 'subtraction':
            return '-';
        case 'multiplication':
            return '*';
        case 'division':
            return '/';
    }
}

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    const data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
}

function submitAnswers() {
    let correct = 0;
    exercises.forEach((ex, index) => {
        const num1Div = document.getElementById(`num1-${index}`);
        const num2Div = document.getElementById(`num2-${index}`);
        const answerDiv = document.getElementById(`answer-${index}`);
        
        const num1Answer = num1Div ? (num1Div.children[0] ? parseInt(num1Div.children[0].innerText) : null) : ex.num1;
        const num2Answer = num2Div ? (num2Div.children[0] ? parseInt(num2Div.children[0].innerText) : null) : ex.num2;
        const resultAnswer = answerDiv ? (answerDiv.children[0] ? parseInt(answerDiv.children[0].innerText) : null) : ex.answer;

        const isNum1Correct = num1Answer === ex.num1;
        const isNum2Correct = num2Answer === ex.num2;
        const isAnswerCorrect = resultAnswer === ex.answer;

        if (isNum1Correct && num1Div) num1Div.style.backgroundColor = 'green';
        else if (num1Div) num1Div.style.backgroundColor = 'red';

        if (isNum2Correct && num2Div) num2Div.style.backgroundColor = 'green';
        else if (num2Div) num2Div.style.backgroundColor = 'red';

        if (isAnswerCorrect && answerDiv) answerDiv.style.backgroundColor = 'green';
        else if (answerDiv) answerDiv.style.backgroundColor = 'red';

        if (isNum1Correct && isNum2Correct && isAnswerCorrect) correct++;
    });
    alert(`Tu as eu ${correct} bonnes réponses!`);


    fetch('_api/api.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({name: localStorage.getItem('userName'), score:correct})
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message);
    })
    .catch(error => console.error('Error:', error));
}