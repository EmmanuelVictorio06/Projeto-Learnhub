var questionCounter = 1; 


window.onload = function() {
    loadSavedQuestions();
};

function submitQuestion(event) {
    event.preventDefault(); 
    var disciplina = document.getElementById("disciplina").value;
    var texto = document.getElementById("texto").value;
    var id =  pad(questionCounter++, 3); 


    saveQuestionToLocalStorage(id, disciplina, texto);

 
    var newQuestion = document.createElement("li");
    newQuestion.className = "quest";

 
    newQuestion.innerHTML = `
        <div class="quest-item">
            <span class="quest-label">ID:</span>
            <span class="quest-id">${id}</span>
        </div>
        <div class="quest-item">
            <span class="quest-label">Disciplina:</span>
            <span class="quest-disc">${disciplina}</span>
        </div>
        <div class="quest-item">
            <span class="quest-label">Descrição:</span>
            <span class="quest-descr">${texto}</span>
        </div>
        <div class="quest-item">
            <span class="quest-label">Data:</span>
            <span class="quest-date">${getCurrentDate()}</span>
        </div>
        <div class="quest-item">
            <span class="quest-label">Status:</span>
            <span class="quest-status">Aguardando resposta</span>
        </div>
    `;


    document.querySelector(".my-quests").appendChild(newQuestion);


    document.getElementById("newQuestionForm").reset();


    document.getElementById("questionForm").style.display = "none";
}

function getCurrentDate() {
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1; 
    var year = date.getFullYear();
    return year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}

function pad(num, size) {
    var s = num + "";
    while (s.length < size) s = "0" + s;
    return s;
}

function saveQuestionToLocalStorage(id, disciplina, texto) {
    var questions = JSON.parse(localStorage.getItem('questions')) || [];
    questions.push({ id: id, disciplina: disciplina, texto: texto });
    localStorage.setItem('questions', JSON.stringify(questions));
}

function loadSavedQuestions() {
    var questions = JSON.parse(localStorage.getItem('questions')) || [];
    questions.forEach(function(question) {
        var newQuestion = document.createElement("li");
        newQuestion.className = "quest";
        newQuestion.innerHTML = `
            <div class="quest-item">
                <span class="quest-label">ID:</span>
                <span class="quest-id">${question.id}</span>
            </div>
            <div class="quest-item">
                <span class="quest-label">Disciplina:</span>
                <span class="quest-disc">${question.disciplina}</span>
            </div>
            <div class="quest-item">
                <span class="quest-label">Descrição:</span>
                <span class="quest-descr">${question.texto}</span>
            </div>
            <div class="quest-item">
                <span class="quest-label">Data:</span>
                <span class="quest-date">${getCurrentDate()}</span>
            </div>
            <div class="quest-item">
                <span class="quest-label">Status:</span>
                <span class="quest-status">Aguardando resposta</span>
            </div>
        `;
        document.querySelector(".my-quests").appendChild(newQuestion);
    });
}