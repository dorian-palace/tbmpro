document.addEventListener("DOMContentLoaded", () => {

    const buttonColorClass = document.getElementsByClassName("select-color");
    const containerHead = document.getElementById("headComponent");
    const containerBody = document.getElementById("bodyComponent");

    for (let i = 0; i < buttonColorClass.length; i++) {

        buttonColorClass[i].addEventListener("click", function () {
            //récupère les têtes et les corps en fonction de leurs couleurs

            const ClearBodyContainer = document.getElementById("bodyComponent");

            // if (ClearBodyContainer != null) {

            //     $(ClearBodyContainer).empty();
            // }

            // const ClearHeadContainer = document.getElementById("headComponent");

            // if (ClearHeadContainer != null) {

            //     $(ClearHeadContainer).empty();
            // }

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
                        const resultBodyColor = dataColor.colorBodyRobots
                        // console.log(resultBodyColor)
                        let images = '';
                        let imagesForBody = '';

                        for (y = 0; y < resultColor.length; ++y) {

                            for (let x = 0; x < resultBodyColor.length; ++x) {
                                // console.log(resultBodyColor[x])

                                imageBody = imagesForBody + '<img id="box-color-body" src="assets/' + resultBodyColor[x].body_name + '"value="' + resultBodyColor[x].body_id + '">';

                                imageHead = images + '<img id="box-color-head" src="assets/' + resultColor[y].head_name + '" value="' + resultColor[y].head_id + '">';
                                // console.table(image)

                                const containerBody = document.getElementById("bodyComponent");
                                const newLabelBody = document.createElement("label");
                                newLabelBody.setAttribute("class", "container-body");
                                newLabelBody.setAttribute("id", "container-label-body");
                                newLabelBody.innerHTML = imageBody;

                                containerBody.appendChild(newLabelBody);

                                const containerHead = document.getElementById("headComponent");
                                const newLabelHead = document.createElement("label");
                                newLabelHead.setAttribute("id", 'thatlabel')
                                newLabelHead.setAttribute("for", 'checkbox');
                                newLabelHead.innerHTML = imageHead;

                                containerHead.appendChild(newLabelHead);
                            }
                        }
                    } catch (error) {
                        console.log('Error parsing JSON:', error, body);
                    }


                });

        });
    }

    //récupère les têtes et les corps en fonctions de leurs materials
    const buttonMaterialClass = document.getElementsByClassName("select-material")

    for (let x = 0; x < buttonMaterialClass.length; x++) {

        buttonMaterialClass[x].addEventListener("click", function () {

            const ClearBodyContainer = document.getElementById("bodyComponent");

            if (ClearBodyContainer != null) {

                $(ClearBodyContainer).empty();
            }

            const ClearHeadContainer = document.getElementById("headComponent");

            if (ClearHeadContainer != null) {

                $(ClearHeadContainer).empty();
            }

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
                    try {
                        dataMaterial = JSON.parse(body);
                        const resultMaterialHead = dataMaterial.materialHeadRobots;
                        const resultMaterialBody = dataMaterial.materialBodyRobots;

                        let images = '';

                        for (y = 0; y < resultMaterialBody.length; ++y) {

                            imageBody = images + '<img id="box-robots-filter" src="assets/' + resultMaterialBody[y].body_name + '" value="' + resultMaterialBody[y].body_id + '">';

                            console.log(imageBody)

                            const container = document.getElementById("headContainer");
                            const newLabel = document.createElement("label");
                            newLabel.setAttribute("for", 'checkbox');
                            newLabel.setAttribute("id", 'thatlabel')
                            newLabel.innerHTML = imageBody;

                            container.appendChild(newLabel);
                        }
                    } catch (error) {
                        console.log('Error parsing JSON:', error, body);
                    }
                });
        });
    }


})