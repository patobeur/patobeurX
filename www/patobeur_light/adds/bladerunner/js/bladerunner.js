"use strict";

window.addEventListener("DOMContentLoaded", (event) => {
    var Start = document.querySelector('#blaster');
    Start.addEventListener("click", (event) => {   
            harrisson();
    });
});


const numbers = [
    [243, 12, 23, 12, 45, 45, 78, 66, 223, 3],
    [34, 2, 1, 553, 23, 4, 66, 23, 4, 55],
    [67, 56, 45, 553, 44, 55, 5, 428, 452, 3],
    [12, 31, 55, 445, 79, 44, 674, 224, 4, 21],
    [4, 2, 3, 52, 13, 51, 44, 1, 67, 5],
    [5, 65, 4, 5, 5, 6, 5, 43, 23, 4424],
    [74, 532, 6, 7, 35, 17, 89, 43, 43, 66],
    [53, 6, 89, 10, 23, 52, 111, 44, 109, 80],
    [67, 6, 53, 537, 2, 168, 16, 2, 1, 8],
    [76, 7, 9, 6, 3, 73, 77, 100, 56, 100]
];
console.log(numbers);
var message = '';
for (let i = 0; i < numbers.length; i++) {
    message += '<div class="ligne">';
    for (let j = 0; j < numbers[i].length; j++) {
        message += diver(numbers[i][j],'harry',[i,j]);
    }
    message += '</div>';
}
if (message!='') document.getElementById('resultats').innerHTML = message;


function diver(message,classs,title){
    let titre = '';
    if (classs!=''){ classs=' class="'+classs+'"';}
    if (title[0]>=0 && title[1]>=0){ titre=' title="celulle('+ (title[0]+1)+','+(title[1]+1)+')"';}
    return '<div'+classs+titre+'>'+message+'</div>';
}
function harrisson() {
    let message = '';
    let message2 = '';
    let classs = '';
    for (let i = 0; i < numbers.length; i++) {
        classs = '';
        message2 = '';
        for (let j = 0; j < numbers[i].length; j++) {
            classs = '';
            if (numbers[i][j] % 2 == 0) {
                numbers[i][j] = "Blade";
                classs = "blade";
            } 
            else if (numbers[i][j] % 2 == 1) {
                numbers[i][j] = "Runner";
                classs = "runner";
            }
            if (classs!='') message2 += diver(numbers[i][j],classs,[i,j]);
        }

        if (message2!='') message +='<div class="ligne"> ' + message2 + ' </div>';
    }
    if (message!='') document.getElementById('resultats').innerHTML = message;

    // console.log('herrisson.map:');
    // console.log(herrisson.map(x => x.map ( x => x % 2 ? "runner" : "blade" )));
}
