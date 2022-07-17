document.addEventListener("DOMContentLoaded", () => {


    const buttonColorClass = document.getElementsByClassName("filter-color");
    for (let i = 0; i < buttonColorClass.length; i++) {

        buttonColorClass[i].addEventListener("click", function () {
            //function qui trie les têtes des robots en fonction de la couleur selectionner

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
                    // console.log(dataColor)
                    const resultBodyColor = dataColor.colorBodyRobots
                    // console.log(resultBodyColor)
                    // console.log(resultColor)

                    let images = '';

                    for (y = 0; y < resultColor.length; ++y) {

                        for (let index = 0; index < resultBodyColor.length; ++index) {

                            const element = resultBodyColor[index].head_name;

                            image = images + '<img id="box-robots-filter" src="../assets/' + resultColor[y].head_name + '">';
                            // console.table(image)

                            const container = document.getElementById("container");
                            const newLabel = document.createElement("label");
                            newLabel.setAttribute("id", 'thatlabel')
                            newLabel.setAttribute("for", 'checkbox');
                            newLabel.innerHTML = image;

                            const newCheckbox = document.createElement("input");
                            newCheckbox.setAttribute("type", 'checkbox');
                            newCheckbox.setAttribute("id", 'checkbox-tete');
                            newCheckbox.setAttribute("name", 'checkbox-tete');
                            newCheckbox.setAttribute("value", resultColor[y].head_id);

                            newLabel.appendChild(newCheckbox)
                            container.appendChild(newLabel);
                        }
                    }
                });

        });
    }

    for (let i = 0; i < buttonColorClass.length; i++) {

        buttonColorClass[i].addEventListener("click", function () {
            //function qui trie le corps des robots en fonction de la couleur selectionner

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
                    // console.log(dataColor)
                    const resultBodyColor = dataColor.colorBodyRobots
                    // console.log(resultBodyColor)
                    // console.log(resultColor)

                    let images = '';

                    for (y = 0; y < resultBodyColor.length; ++y) {

                        for (let index = 0; index < resultBodyColor.length; ++index) {
                            // console.log(resultBodyColor)
                            const element = resultBodyColor[index].name;
                            // console.log(element)
                            // console.log(resultColor)
                            // console.log(resultBodyColor[y].name)
                            // const nbColor = resultColor[y].name
                            // const arrayColor = [element,
                            //     nbColor
                            // ]
                            // console.log(arrayColor)
                            // const nbBodyColor = resultBodyColor[y].name
                            // console.log(nbColor)

                            // const allColor = [resultColor, nbBodyColor]
                            // console.log(allColor)
                            // console.log(allColor)

                            image = images + '<img id="box-robots-filter" src="../assets/' + resultBodyColor[y].body_name + '">';
                            // console.table(image)

                            const container = document.getElementById("container");
                            const newLabel = document.createElement("label");
                            newLabel.setAttribute("id", 'thatlabel')
                            newLabel.setAttribute("for", 'checkbox');
                            newLabel.innerHTML = image;

                            const newCheckbox = document.createElement("input");
                            newCheckbox.setAttribute("type", 'checkbox');
                            newCheckbox.setAttribute("id", 'checkbox-body');
                            newCheckbox.setAttribute("name", 'checkbox-body');
                            newCheckbox.setAttribute("value", resultBodyColor[y].id);

                            newLabel.appendChild(newCheckbox)
                            container.appendChild(newLabel);
                        }
                    }
                });

        });
    }

    const buttonMaterialClass = document.getElementsByClassName("filter-mat")

    for (let x = 0; x < buttonMaterialClass.length; x++) {

        buttonMaterialClass[x].addEventListener("click", function () {
            /**
             * function qui trie les robots en fonction de la matière de leurs corps
             */

            const oldContainer = document.getElementById("container");

            if (oldContainer != null) {

                $(oldContainer).empty();
            }

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

                        image = images + '<img id="box-robots-filter" src="../assets/' + resDAta[y].head_name + '">';

                        const container = document.getElementById("container");
                        const newLabel = document.createElement("label");
                        newLabel.setAttribute("for", 'checkbox');
                        newLabel.setAttribute("id", 'thatlabel')
                        newLabel.innerHTML = image;

                        const newCheckbox = document.createElement("input");
                        newCheckbox.setAttribute("type", 'checkbox');
                        newCheckbox.setAttribute("id", 'checkbox');
                        newCheckbox.setAttribute("name", 'checkbox');
                        newCheckbox.setAttribute("aria-labelledby", 'thatlabel')
                        newCheckbox.setAttribute("value", resDAta[y].head_id);

                        newLabel.appendChild(newCheckbox)

                        container.appendChild(newLabel);
                        // container.appendChild(newCheckbox);


                    }
                });
        });
    }

    for (let x = 0; x < buttonMaterialClass.length; x++) {

        buttonMaterialClass[x].addEventListener("click", function () {
            /**
             * function qui trie les robots en fonction de la matière de leurs tête
             */
            const oldContainer = document.getElementById("container");

            if (oldContainer != null) {

                $(oldContainer).empty();
            }

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
                    const resDAta = mydata.materialBodyRobots;
                    // console.log(resDAta)
                    let images = '';
                    
                    for (y = 0; y < resDAta.length; ++y) {
                        // console.log(resDAta)

                        image = images + '<img id="box-robots-filter" src="../assets/' + resDAta[y].body_name + '">';

                        const container = document.getElementById("container");
                        const newLabel = document.createElement("label");
                        newLabel.setAttribute("for", 'checkbox');
                        newLabel.setAttribute("id", 'thatlabel')
                        newLabel.innerHTML = image;

                        const newCheckbox = document.createElement("input");
                        newCheckbox.setAttribute("type", 'checkbox');
                        newCheckbox.setAttribute("id", 'checkbox');
                        newCheckbox.setAttribute("name", 'checkbox');
                        newCheckbox.setAttribute("aria-labelledby", 'thatlabel')
                        newCheckbox.setAttribute("value", resDAta[y].body_id);

                        newLabel.appendChild(newCheckbox)
                        container.appendChild(newLabel);
                        // container.appendChild(newCheckbox);
                    }
                });
        });
    }

    const submitRobot = document.getElementById("submit-robot");
    console.log(submitRobot)
    submitRobot.addEventListener("click", () => {

        const getCategories = document.getElementById("categorieNewRobot");
        const nameRobot = document.getElementById("name-robot");
        const checkboxHead = document.getElementById("checkbox-tete")
        const checkboxBody = document.getElementById("checkbox-body")

        const dataCategorie = new FormData();
        dataCategorie.append("categorie-robot", getCategories.value);
        dataCategorie.append("submit-robot", submitRobot.value);
        dataCategorie.append("name-robot", nameRobot.value);
        dataCategorie.append("checkbox-head-robot", checkboxHead.value);
        dataCategorie.append("checkbox-body-robot", checkboxBody.value);
        

        // let btnValue = submitRobot.value;
        // const dataButton = new FormData();
        // console.log(dataButton)
        // dataButton.append("submit-robot", submitRobot.value);
        // console.log(dataButton)
        fetch('adminRouteurJs.php', {
                method: 'POST',
                body: dataCategorie
            })
            .then(response => response.text())
            .then(body => {
                console.log(body)
            })
    });

    submitRobot.addEventListener("click", function () {
        // get categories 
    
        fetch('adminRouteurJs.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.text())
            .then(body => {
                console.log(body)
            })
    })

    submitRobot.addEventListener("click", function () {
        //récupère le nom du robot
        const nameRobot = document.getElementById("name-robot");

        const data = new FormData();
        data.append("name-robot", nameRobot.value);

        fetch('adminRouteurJs.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.text())
            .then(body => {
                console.log(body)
            })
    })


    submitRobot.addEventListener("click", function () {
        //récupère l'id de la checkbox qui correspond a l'id de l'image
        // id tete
        const checkbox = document.getElementById("checkbox-tete")
        // console.log(checkbox)

        const data = new FormData();
        data.append("checkbox-head-robot", checkbox.value);

        fetch('adminRouteurJs.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.text())
            .then(body => {
                console.log(body)
            })
    })

    submitRobot.addEventListener("click", function () {
        //récupère l'id de la checkbox qui correspond a l'id de l'image
        // id body
        const checkbox = document.getElementById("checkbox-body")
        // console.log(checkbox)

        const data = new FormData();
        data.append("checkbox-body-robot", checkbox.value);

        fetch('adminRouteurJs.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.text())
            .then(body => {
                console.log(body)
            })
    })

})