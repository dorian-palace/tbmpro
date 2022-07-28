let state = {
    numberIndex_head : 0,
    numberIndex_body : 0
};


let headData = [];
let bodyData = [];


fetch('/tbmpro/heads.json')
.then((res) => res.json())
.then(function(data) {
    data.forEach(function(item) {
        item = item;
        headData.push(item);
    });
    return headData;  
});

fetch('/tbmpro/bodies.json')
.then((res) => res.json())
.then(function(data) {
    data.forEach(function(item) {
        item = item;
        bodyData.push(item);
    });
    return bodyData;  
});


console.log(bodyData);
console.log(headData);




function nexthead() {
    let head = document.querySelector("#head");
    if (state.numberIndex_head < headData.length - 1) {
        state.numberIndex_head++;
        console.log(state.numberIndex_head);
        console.log(headData[state.numberIndex_head]["head_name"]);
        head.setAttribute("class", `head${state.numberIndex_head}`);
    } else if (state.numberIndex_head === headData.length - 1) {
        state.numberIndex_head = 0;
        console.log(headData[state.numberIndex_head]["head_name"]);
        console.log(state.numberIndex_head);
        head.setAttribute("class", `head${state.numberIndex_head}`);
    }
    

}

function nextbody() {
    let body = document.querySelector("#body");
    if (state.numberIndex_body < bodyData.length) {
      state.numberIndex_body++;
      console.log(bodyData[state.numberIndex_body]["body_name"]);
      body.setAttribute("class", `body${state.numberIndex_body}`);
    } else if (state.numberIndex_body === bodyData.length) {
      state.numberIndex_body = 0;
      body.setAttribute("class", `body${state.numberIndex_body}`);
    }
}

                



