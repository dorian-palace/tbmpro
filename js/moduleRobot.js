let state = {
    numberIndex_head : 0,
    numberIndex_body : 0
};


let headData = [];


fetch('/tbmpro/heads.json')
.then((res) => res.json())
.then(function(data) {
    data.forEach(function(item) {
        item = item;
        headData.push(item);
    });
    return headData;  
});

console.log(headData);

nexthead();


function nexthead() {
    let head = document.querySelector("#head");
    if (state.head < 7) {
      state.head++;
      head.setAttribute("class", `head${state.head}`);
    } else if (state.head === 7) {
      state.head = 0;
      head.setAttribute("class", `head${state.head}`);
    }
}


                



