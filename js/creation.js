document.addEventListener("DOMContentLoaded", () => {

    const buttonHeadColorClass = document.getElementsByClassName("select-color-head");
    const containerHead = document.getElementById("headComponent");
    const containerBody = document.getElementById("bodyComponent");

    GetHeadComponentByColor = function () {

        for (let i = 0; i < buttonHeadColorClass.length; i++) {

            buttonHeadColorClass[i].addEventListener("click", function () {
                //récupère les têtes en fonction de leurs couleurs

                // const ClearBodyContainer = document.getElementById("bodyComponent");

                const idButton = buttonHeadColorClass[i].id;
                console.log(idButton);
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

                                imageHead = images + '<div onclick="mooveHead(' + resultColor[y].head_id + ')" id="headMaterialContainer" class="headMaterialContainer""><img id="box-color-head" src="assets/' + resultColor[y].head_name + '" value="' + resultColor[y].head_id + '"></div>';

                                const containerHead = document.getElementById("headComponent");
                                const newContainer = document.createElement("button");

                                newContainer.innerHTML = imageHead;
                                // container.appendChild(newContainer);


                                containerHead.appendChild(newContainer);
                            }

                        } catch (error) {
                            console.log('Error parsing JSON:', error, body);
                        }

                    });
            });
        }
    }
    GetHeadComponentByColor();

    const buttonBodyColorClass = document.getElementsByClassName("select-color-body");

    GetBodyComponentByColor = function () {

        for (let i = 0; i < buttonBodyColorClass.length; i++) {

            buttonBodyColorClass[i].addEventListener("click", function () {
                //récupère les têtes et les corps en fonction de leurs couleurs

                // const ClearBodyContainer = document.getElementById("bodyComponent");
                // console.log(buttonBodyColorClass)
                const idButton = buttonBodyColorClass[i].id;
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

                            for (let x = 0; x < resultBodyColor.length; ++x) {
                                // console.log(resultBodyColor[x])

                                imageBody = imagesForBody + '<div onclick="mooveBody(' + resultBodyColor[x].body_id + ')" id="headMaterialContainer" class="headMaterialContainer""><img id="box-color-body" src="assets/' + resultBodyColor[x].body_name + '"value="' + resultBodyColor[x].body_id + '"></div>';

                                // imageBody = images + '<div onclick="mooveHead(' + resultMaterialHead[y].head_id + ')" id="headMaterialContainer" class="headMaterialContainer""> <img class="box-head-filter" id="box-head-filter" class="body-material-component" src="assets/' + resultMaterialHead[y].head_name + '" value="' + resultMaterialHead[y].head_id + '"></div>';


                                const containerBody = document.getElementById("bodyComponent");
                                const newContainer = document.createElement("button");

                                newContainer.innerHTML = imageBody;

                                containerBody.appendChild(newContainer);
                            }
                        } catch (error) {
                            console.log('Error parsing JSON:', error, body);
                        }

                    });
            });
        }
    }
    GetBodyComponentByColor();

    const buttonHeadMaterialClass = document.getElementsByClassName("select-material-head");

    GetHeadComponentByMaterial = function () {

        for (let x = 0; x < buttonHeadMaterialClass.length; x++) {

            buttonHeadMaterialClass[x].addEventListener("click", function () {

                const idButtonMat = buttonHeadMaterialClass[x].id
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

                            imageBody = images + '<div onclick="mooveHead(' + resultMaterialHead[y].head_id + ')" id="headMaterialContainer" class="headMaterialContainer""> <img class="box-head-filter" id="box-head-filter" class="body-material-component" src="assets/' + resultMaterialHead[y].head_name + '" value="' + resultMaterialHead[y].head_id + '"></div>';

                            const container = document.getElementById("headComponent");
                            const newContainer = document.createElement("button");

                            newContainer.innerHTML = imageBody;
                            container.appendChild(newContainer);

                        }
                    });
            });
        }
    }
    GetHeadComponentByMaterial();


    // toto = function (e) {

    //     console.log(e)
    //     // const imageBodyMaterial = document.getElementsByClassName('body-material-component');

    //     // // console.log(imageBodyMaterial)
    //     // const leftContainer = document.getElementsByClassName("bodyComponent");
    //     // // console.log(leftContainer[O].children)

    //     // const bodyContainer = document.getElementsByClassName("newdiv");
    //     // // console.log(leftContainer[0].children[1])
    //     // // console.log(bodyContainer)

    //     // // var all_img = leftContainer.getElementsByTagName("img");
    //     // // console.log(all_img)

    //     // for (let i = 0; i < leftContainer[0].children.length; i++) {
    //     //     // console.log(leftContainer[0].children[i])



    //     //     // const valueImage = imageBodyMaterial[i].getAttribute('value');
    //     //     // console.log(valueImage)

    //     //     const mainContainer = document.getElementsByClassName("bodyContainer");
    //     //     // const body_layer = document.querySelector('#bodyContainer');
    //     //     // console.log(body_layer)

    //     //     // console.log(mainContainer[0].children.length)

    //     //     console.log(leftContainer[0].children)

    //     //     $(leftContainer[0].children[i]).on('click', function () {


    //     //         if (mainContainer[0].children.length == 0) {
    //     //             $(mainContainer).append(leftContainer[0].children[i]);
    //     //             i = 0
    //     //             // console.log('ok')
    //     //         } else {
    //     //             $(leftContainer).append(mainContainer[0].children[0]);
    //     //             console.log(mainContainer[0].children.length)
    //     //             i = 0

    //     //             $(mainContainer).append(leftContainer[0].children[i]);
    //     //         }

    //     //     });

    //     // }

    // }


    const buttonBodyMaterialClass = document.getElementsByClassName("select-material-body")

    GetBodyComponentByMaterial = function () {




        for (let x = 0; x < buttonBodyMaterialClass.length; x++) {

            buttonBodyMaterialClass[x].addEventListener("click", function () {

                const idButtonMat = buttonBodyMaterialClass[x].id
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

                            imageBody = images + '<div onclick="mooveBody(' + resultMaterialBody[y].body_id + ')" id="bodyMaterialContainer" class="bodyMaterialContainer""> <img id="box-body-filter" class="body-material-component" src="assets/' + resultMaterialBody[y].body_name + '" value="' + resultMaterialBody[y].body_id + '"></div>';

                            const container = document.getElementById("bodyComponent");
                            const newContainer = document.createElement("button");
                            // newLabel.setAttribute("for", 'checkbox');
                            // newContainer.setAttribute("id", 'newdiv')
                            // newContainer.setAttribute("class", "newdiv");
                            newContainer.innerHTML = imageBody;

                            // const newContainer = document.createElement("div");
                            // newContainer.setAttribute("class", "container-test");
                            // newContainer.setAttribute("id", "container-test");
                            // newContainer.innerHTML = imageBody
                            // newContainer.appendChild(newLabel);

                            // container.innerHTML = imageBody;
                            container.appendChild(newContainer);

                        }
                        // toto();

                    });
            });
        }
    }
    GetBodyComponentByMaterial();



    // for (let index = 0; index < buttonBodyMaterialClass.length; index++) {
    //     // const element = array[index];


    //     buttonBodyMaterialClass[index].addEventListener("click", function () {



    //     })
    // }

    // function myFunction() {




    //     for (let index = 0; index < buttonBodyMaterialClass.length; index++) {
    //         // const element = array[index];


    //         buttonBodyMaterialClass[index].addEventListener("click", function () {

    //             const collection = document.getElementById("container-test");
    //             console.log(collection)

    //             // for (let i = 0; i < collection.length; i++) {
    //             //     const element = collection[i];
    //             //     console.log(element.value)

    //             // }

    //             for (let i = 0; i < collection; i++) {

    //                 console.log(collection[i])
    //                 // collection.item(i).style.fontSize = "24px";
    //             }
    //         })
    //     }
    // }


    // myFunction();

    
})