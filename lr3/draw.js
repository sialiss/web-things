// let canvas = document.getElementById("drawingCanvas");
// let context = canvas.getContext("2d");
// context.clearRect(0, 0, 400, 300);

// const size = parseInt(prompt("Введите размер фигуры (ex. 5):"));
// const block_size = parseInt(prompt("Введите размер стороны квадратика (ex. 10):"));

// //проверка
// if (isNaN(size) || (size < 1) || isNaN(block_size) || (block_size < 1)) {
//     context.fillStyle = "black";
//     context.font = "20px serif";
//     context.fillText("Неправильные входные данные", 10, 50);


// } else {
//     let s = (size - 1) * block_size;
//     for(let i = 0; i <= s*4; i+=2*block_size){
//         let a = Math.abs(i-s*2);
//         for(let j = 0; j < s*2+block_size-Math.abs(s*2-i); j+=block_size){
//             context.fillStyle = "blue";
//             context.fillRect(i,a,block_size,block_size);
//             a+=2*block_size;
//         }
//     }
//     for(let i = 0; i <= s*4; i+=2*block_size){
//         for(let j = s*4+2*block_size; j <= s*4+6*block_size; j += 2*block_size){
//             context.fillRect(i,j,block_size,block_size);
//         }
//     }
// }





const canvas = document.getElementById("drawingCanvas");
const context = canvas.getContext("2d");
context.clearRect(0, 0, 400, 300);

const size = parseInt(prompt("Введите размер фигуры:"));
const block_size = parseInt(prompt("Введите размер стороны квадратика:"));

let s = (size - 1) * block_size;
for(let i = 0; i <= s*4; i+=2*block_size){
    let a = Math.abs(i-s*2);
    for(let j = 0; j < s*2+block_size-Math.abs(s*2-i); j+=block_size){
        context.fillStyle = "blue";
        context.fillRect(i,a,block_size,block_size);
        a+=2*block_size;
    }
}
for(let i = 0; i <= s*4; i+=2*block_size){
    for(let j = s*4+2*block_size; j <= s*4+6*block_size; j += 2*block_size){
        context.fillRect(i,j,block_size,block_size);
    }
}