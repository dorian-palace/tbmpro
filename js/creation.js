document.addEventListener("DOMContentLoaded", () => {

    const buttonColorClass = document.getElementsByClassName("select-color");
    const containerHead = document.getElementById("headComponent");
    const containerBody = document.getElementById("bodyComponent");

    GetHeadComponentByColor = function () {

        for (let i = 0; i < buttonColorClass.length; i++) {

            buttonColorClass[i].addEventListener("click", function () {
                //récupère les têtes et les corps en fonction de leurs couleurs

                const ClearBodyContainer = document.getElementById("bodyComponent");

                const idButton = buttonColorClass[i].id;
                // console.log(idButton);
                const params = idButton.substring(13);
                // console.log(params)
                const data = new FormData();
                data.append("select_color", params);

                fetch('app/traitementRobot.php', {
                        method: 'POST',
                        body: data,
                    })
                    .then(response => response.text())
                    .then(body => {
                        try {
                            dataColor = JSON.parse(body);
                            const resultColor = dataColor.colorHeadRobots
                            // console.log(resultColor)

                            // console.log(resultBodyColor)
                            let images = '';

                            for (y = 0; y < resultColor.length; ++y) {

                                imageHead = images + '<img id="box-color-head" src="assets/' + resultColor[y].head_name + '" value="' + resultColor[y].head_id + '">';

                                const containerHead = document.getElementById("headComponent");
                                const newLabelHead = document.createElement("label");
                                newLabelHead.setAttribute("id", 'thatlabel')
                                newLabelHead.setAttribute("for", 'checkbox');
                                newLabelHead.innerHTML = imageHead;

                                containerHead.appendChild(newLabelHead);

                            }

                        } catch (error) {
                            console.log('Error parsing JSON:', error, body);
                        }

                    });
            });
        }
    }
    GetHeadComponentByColor();

    GetBodyComponentByColor = function () {

        for (let i = 0; i < buttonColorClass.length; i++) {

            buttonColorClass[i].addEventListener("click", function () {
                //récupère les têtes et les corps en fonction de leurs couleurs

                const ClearBodyContainer = document.getElementById("bodyComponent");

                const idButton = buttonColorClass[i].id;
                // console.log(idButton);
                const params = idButton.substring(13);
                // console.log(params)
                const data = new FormData();
                data.append("select_color", params);

                fetch('app/traitementRobot.php', {
                        method: 'POST',
                        body: data,
                    })
                    .then(response => response.text())
                    .then(body => {
                        try {
                            dataColor = JSON.parse(body);

                            const resultBodyColor = dataColor.colorBodyRobots
                            // console.log(resultBodyColor)
                            let imagesForBody = '';

                            for (let x = 0; x < (resultBodyColor.length) - 1; ++x) {
                                // console.log(resultBodyColor[x])

                                imageBody = imagesForBody + '<img id="box-color-body" src="assets/' + resultBodyColor[x].body_name + '"value="' + resultBodyColor[x].body_id + '">';

                                const containerBody = document.getElementById("bodyComponent");
                                const newLabelBody = document.createElement("label");
                                newLabelBody.setAttribute("class", "container-body");
                                newLabelBody.setAttribute("id", "container-label-body");
                                newLabelBody.innerHTML = imageBody;

                                containerBody.appendChild(newLabelBody);
                            }

                        } catch (error) {
                            console.log('Error parsing JSON:', error, body);
                        }

                    });
            });
        }
    }
    GetBodyComponentByColor();
    // while (toto == true || ClearBodyContainer == false) {
    //     $(tata).html("");
    // }
    //récupère les têtes et les corps en fonctions de leurs materials
    const buttonMaterialClass = document.getElementsByClassName("select-material")



    GetHeadComponentByMaterial = function () {

        for (let x = 0; x < buttonMaterialClass.length; x++) {

            buttonMaterialClass[x].addEventListener("click", function () {

                const idButtonMat = buttonMaterialClass[x].id
                // console.log(idButtonMat)
                const paramsMat = idButtonMat.substring(16);
                // console.log(paramsMat)
                const dataMat = new FormData();
                dataMat.append("select_mat", paramsMat);

                fetch('app/traitementRobot.php', {
                        method: 'POST',
                        body: dataMat
                    })
                    .then(response => response.text())
                    .then(body => {

                        dataMaterial = JSON.parse(body);
                        const resultMaterialHead = dataMaterial.materialHeadRobots;

                        let images = '';

                        for (y = 0; y < resultMaterialHead.length; ++y) {

                            imageBody = images + '<img id="box-robots-filter" class="body-material-component" src="assets/' + resultMaterialHead[y].head_name + '" value="' + resultMaterialHead[y].head_id + '">';

                            const container = document.getElementById("headContainer");
                            const newLabel = document.createElement("label");
                            newLabel.setAttribute("for", 'checkbox');
                            newLabel.setAttribute("id", 'thatlabel')
                            newLabel.innerHTML = imageBody;

                            const newContainer = document.createElement("div");
                            newContainer.setAttribute("class", "container-test");
                            newContainer.setAttribute("id", "container-test");
                            newContainer.appendChild(newLabel);
                            container.appendChild(newContainer);

                        }
                    });
            });
        }
    }
    GetHeadComponentByMaterial();

    GetBodyComponentByMaterial = function () {

        for (let x = 0; x < buttonMaterialClass.length; x++) {

            buttonMaterialClass[x].addEventListener("click", function () {

                const idButtonMat = buttonMaterialClass[x].id
                // console.log(idButtonMat)
                const paramsMat = idButtonMat.substring(16);
                // console.log(paramsMat)
                const dataMat = new FormData();
                dataMat.append("select_mat", paramsMat);

                fetch('app/traitementRobot.php', {
                        method: 'POST',
                        body: dataMat
                    })
                    .then(response => response.text())
                    .then(body => {

                        dataMaterial = JSON.parse(body);
                        const resultMaterialBody = dataMaterial.materialBodyRobots;
                        //Ajout des têtes a faore 
                        let images = '';

                        for (y = 0; y < resultMaterialBody.length; ++y) {

                            imageBody = images + '<img id="box-robots-filter" class="body-material-component" src="assets/' + resultMaterialBody[y].body_name + '" value="' + resultMaterialBody[y].body_id + '">';

                            const container = document.getElementById("headContainer");
                            const newLabel = document.createElement("label");
                            newLabel.setAttribute("for", 'checkbox');
                            newLabel.setAttribute("id", 'thatlabel')
                            newLabel.innerHTML = imageBody;

                            const newContainer = document.createElement("div");
                            newContainer.setAttribute("class", "container-test");
                            newContainer.setAttribute("id", "container-test");
                            newContainer.appendChild(newLabel);
                            container.appendChild(newContainer);

                        }
                    });
            });
        }
    }
    GetBodyComponentByMaterial();
})