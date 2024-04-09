// Функция для создания матрицы с заданным числом строк и столбцов
function createMatrix(rows, cols) {
    let matrix = [];
    for (let i = 0; i < rows; i++) {
        matrix[i] = [];
        for (let j = 0; j < cols; j++) {
            // Генерация случайного числа от 1 до 100
            matrix[i][j] = Math.floor(Math.random() * 100) + 1;
        }
    }
    return matrix;
}

function displayMatrix(matrix) {
    let output = document.getElementById('myrezult');
    output.innerHTML = ''

    // Выводим матрицу на страницу
    matrix.forEach(row => {
        const rowElement = document.createElement('div');
        rowElement.textContent = row.join(' ');
        output.appendChild(rowElement);
    });
    
    // Запрос у пользователя порогового значения
    let threshold = parseInt(prompt("Введите пороговое значение для среднего:"));

    // Нахождение количества строк матрицы, среднее арифметическое элементов которых меньше заданной величины
    let rowCount = countRowsWithAverageLessThan(matrix, threshold);

    let printRowCount = document.createElement('p')
    printRowCount.innerHTML = `Количество строк с средним меньше ${threshold}: ${rowCount}`;
    output.appendChild(printRowCount)
}

// Функция для нахождения количества строк матрицы,
// среднее арифметическое элементов которых меньше заданной величины
function countRowsWithAverageLessThan(matrix, threshold) {
    let count = 0;
    for (let i = 0; i < matrix.length; i++) {
        let sum = matrix[i].reduce((acc, val) => acc + val, 0);
        let average = sum / matrix[i].length;
        if (average < threshold) {
            count++;
        }
    }
    return count;
}

// Запрос у пользователя количества строк и столбцов матрицы
let rows = parseInt(prompt("Введите количество строк:"));
let cols = parseInt(prompt("Введите количество столбцов:"));

// Создание матрицы
let matrix = createMatrix(rows, cols);

// Вывод матрицы
displayMatrix(matrix);