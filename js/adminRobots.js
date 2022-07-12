document.addEventListener("DOMContentLoaded", () => {

    const buttonColorClass = document.getElementsByClassName("filter-color");
    for (let i = 0; i < buttonColorClass.length; i++) {

        buttonColorClass[i].addEventListener("click", function () {

            const oldContainer = document.getElementById("container");
            // console.log(oldContainer)

            if (oldContainer != null) {
                $(oldContainer).empty();
                // console.log(oldContainer)
            }

            const idButton = buttonColorClass[i].id;
            const params = idButton.substring(13);
            const data = new FormData();
            data.append("select_color", params);

            fetch('adminRouteurJs.php', {
                    method: 'POST',
                    body: data
                })
                .then(response => response.text())
                .then(body => {
                    const dataColor = JSON.parse(body);
                    const resultColor = dataColor.colorHeadRobots
                    // console.log(resultColor)

                    let images = '';

                    for (y = 0; y < resultColor.length; ++y) {

                        images = images + '<img id="box-robots-filter" src="../assets/' + resultColor[y].name + '">';

                        const container = document.getElementById("container");
                        const newLabel = document.createElement("label");
                        newLabel.setAttribute("for", 'checkbox');
                        newLabel.innerHTML = images;

                        const newCheckbox = document.createElement("input");
                        newCheckbox.setAttribute("type", 'checkbox');
                        newCheckbox.setAttribute("id", 'checkbox');
                        newCheckbox.setAttribute("name", 'checkbox');
                        newCheckbox.setAttribute("value", resultColor[y].id);

                        container.appendChild(newLabel);
                        container.appendChild(newCheckbox);
                    }
                });

        });
        // return tata
    }
    // const myset = new Set();
    // // console.log(myset);
    // const toto = document.getElementById("container");
    // console.log(toto)
    // myset.add(toto);
    // console.log(myset);
    const buttonMaterialClass = document.getElementsByClassName("filter-mat")

    for (let x = 0; x < buttonMaterialClass.length; x++) {

        buttonMaterialClass[x].addEventListener("click", function () {


            const oldContainer = document.getElementById("container");
            // console.log(oldContainer)

            if (oldContainer != null) {
                $(oldContainer).empty();
                // console.log(oldContainer)
            }
            // oldConsole.log(oldContainer);
            // oldContainer.innerHTML = "";
            // console.log(oldContainer);


            const idButtonMat = buttonMaterialClass[x].id
            const paramsMat = idButtonMat.substring(11);

            const dataMat = new FormData();
            dataMat.append("select_mat", paramsMat);

            fetch('adminRouteurJs.php', {
                    method: 'POST',
                    body: dataMat
                })
                .then(response => response.text())
                .then(data => {

                    const mydata = JSON.parse(data);
                    // console.log(mydata)
                    const resDAta = mydata.materialHeadRobots;
                    // console.log(resDAta)
                    let images = '';

                    for (y = 0; y < resDAta.length; ++y) {

                        images = images + '<img id="box-robots-filter" src="../assets/' + resDAta[y].name + '">';

                        const container = document.getElementById("container");
                        const newLabel = document.createElement("label");
                        newLabel.setAttribute("for", 'checkbox');
                        newLabel.innerHTML = images;

                        const newCheckbox = document.createElement("input");
                        newCheckbox.setAttribute("type", 'checkbox');
                        newCheckbox.setAttribute("id", 'checkbox');
                        newCheckbox.setAttribute("name", 'checkbox');
                        newCheckbox.setAttribute("value", resDAta[y].id);

                        container.appendChild(newLabel);
                        container.appendChild(newCheckbox);


                    }
                });
        });
        // return mata;
    }

    const submitRobot = document.getElementById("submit-robot");
    const nameRobot = document.getElementById("name-robot");
    // get both checkbox value for the FormData to send to phph traitement


    submitRobot.addEventListener("click", function () {
        //submit new robot

        const checkbox = document.getElementById("checkbox");
        console.log(checkbox);

        const data = new FormData();
        data.append("name-robot", nameRobot.value);

        fetch('adminRouteurJs.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.text())
            .then(body => {
                // const data = JSON.parse(body);
                // const result = data.nameRobot;
                console.log(body)
                // console.log(result)

            })
    })

    // buttonColorClass.addEventListener("click", function () {
    //     //clear container
    //     const container = document.getElementById("container");
    //     console.log(container);
    //     container.innerHTML = "";
    //     console.log(container);

    // })
})