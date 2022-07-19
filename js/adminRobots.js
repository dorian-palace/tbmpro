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

                            const newRadio = document.createElement("input");
                            newRadio.setAttribute("type", 'radio');
                            newRadio.setAttribute("id", 'radio-head');
                            newRadio.setAttribute("name", 'radio-head');
                            newRadio.setAttribute("aria-labelledby", 'thatlabel')
                            newRadio.setAttribute("value", resultColor[y].head_id);


                            newLabel.appendChild(newRadio)
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

                    let images = '';

                    for (y = 0; y < resultBodyColor.length; ++y) {

                        // console.log(resultBodyColor)
                        for (let index = 0; index < resultBodyColor.length; ++index) {
                            const element = resultBodyColor[index];

                            image = images + '<img id="box-robots-filter" src="../assets/' + resultBodyColor[y].body_name + '">';

                            
                            // console.table(image)

                            const container = document.getElementById("container");
                            const newLabel = document.createElement("label");
                            newLabel.setAttribute("id", 'thatlabel')
                            newLabel.setAttribute("for", 'checkbox');
                            newLabel.innerHTML = image;

                            const newRadio = document.createElement("input");
                            newRadio.setAttribute("type", 'radio');
                            newRadio.setAttribute("id", 'radio-body');
                            newRadio.setAttribute("name", 'radio-body');
                            newRadio.setAttribute("aria-labelledby", 'thatlabel')
                            newRadio.setAttribute("value", resultBodyColor[y].body_id);


                            newLabel.appendChild(newRadio)
                            container.appendChild(newLabel);
                        }
                    }
                });

        });
    }

    // const buttonMaterialClass = document.getElementsByClassName("filter-mat")

    // for (let x = 0; x < buttonMaterialClass.length; x++) {

    //     buttonMaterialClass[x].addEventListener("click", function () {
    //         /**
    //          * function qui trie les robots en fonction de la matière de leurs corps
    //          */

    //         const oldContainer = document.getElementById("container");

    //         if (oldContainer != null) {

    //             $(oldContainer).empty();
    //         }

    //         const idButtonMat = buttonMaterialClass[x].id
    //         const paramsMat = idButtonMat.substring(11);

    //         const dataMat = new FormData();
    //         dataMat.append("select_mat", paramsMat);

    //         fetch('adminRouteurJs.php', {
    //                 method: 'POST',
    //                 body: dataMat
    //             })
    //             .then(response => response.text())
    //             .then(data => {

    //                 const mydata = JSON.parse(data);
    //                 // console.log(mydata)
    //                 const resDAta = mydata.materialHeadRobots;
    //                 // console.log(resDAta)
    //                 let images = '';

    //                 for (y = 0; y < resDAta.length; ++y) {

    //                     image = images + '<img id="box-robots-filter" src="../assets/' + resDAta[y].head_name + '">';

    //                     const container = document.getElementById("container");
    //                     const newLabel = document.createElement("label");
    //                     newLabel.setAttribute("for", 'checkbox');
    //                     newLabel.setAttribute("id", 'thatlabel')
    //                     newLabel.innerHTML = image;

    //                     const newRadio = document.createElement("input");
    //                     newRadio.setAttribute("type", 'radio');
    //                     newRadio.setAttribute("id", 'radio-head');
    //                     newRadio.setAttribute("name", 'radio-head');
    //                     newRadio.setAttribute("aria-labelledby", 'thatlabel')
    //                     newRadio.setAttribute("value", resDAta[y].head_id);

    //                     newLabel.appendChild(newRadio)
    //                     container.appendChild(newLabel);
    //                 }
    //             });
    //     });
    // }

    // for (let x = 0; x < buttonMaterialClass.length; x++) {

    //     buttonMaterialClass[x].addEventListener("click", function () {
    //         /**
    //          * function qui trie les robots en fonction de la matière de leurs tête
    //          */
    //         const oldContainer = document.getElementById("container");

    //         if (oldContainer != null) {

    //             $(oldContainer).empty();
    //         }

    //         const idButtonMat = buttonMaterialClass[x].id
    //         const paramsMat = idButtonMat.substring(11);

    //         const dataMat = new FormData();
    //         dataMat.append("select_mat", paramsMat);

    //         fetch('adminRouteurJs.php', {
    //                 method: 'POST',
    //                 body: dataMat
    //             })
    //             .then(response => response.text())
    //             .then(data => {

    //                 const mydata = JSON.parse(data);
    //                 // console.log(mydata)
    //                 const resDAta = mydata.materialBodyRobots;

    //                 let images = '';

    //                 for (y = 0; y < resDAta.length; ++y) {

    //                     image = images + '<img id="box-robots-filter" src="../assets/' + resDAta[y].body_name + '">';

    //                     const container = document.getElementById("container");
    //                     const newLabel = document.createElement("label");
    //                     newLabel.setAttribute("for", 'radio');
    //                     newLabel.setAttribute("id", 'thatlabel')
    //                     newLabel.innerHTML = image;

    //                     const newRadio = document.createElement("input");
    //                     newRadio.setAttribute("type", 'radio');
    //                     newRadio.setAttribute("id", 'radio-body');
    //                     newRadio.setAttribute("name", 'radio-body');
    //                     newRadio.setAttribute("aria-labelledby", 'thatlabel')
    //                     newRadio.setAttribute("value", resDAta[y].body_id);

    //                     newLabel.appendChild(newRadio)
    //                     container.appendChild(newLabel);
    //                 }
    //             });
    //     });
    // }

    const deleteRobot = document.getElementsByName("delete-robot");

    for (let z = 0; z < deleteRobot.length; z++) {

        deleteRobot[z].addEventListener("click", function () {

            const idRobot = deleteRobot[z].value

            const deleteData = new FormData();
            deleteData.append("delete-robot", idRobot);

            fetch('adminRouteurJs.php', {
                    method: 'POST',
                    body: deleteData
                })
                .then(response => response.text())

                .then(data => {
                    // console.log(data)
                    window.location.reload();
                })
        })
    }
    const deleteHead = document.getElementsByName("delete-head");
    // console.log(deleteHead)

    for (let z = 0; z < deleteHead.length; z++) {

        deleteHead[z].addEventListener("click", function () {

            const idHead = deleteHead[z].value
            const deleteData = new FormData();
            deleteData.append("delete-head", idHead);
            // console.log(deleteData)

            fetch('adminRouteurJs.php', {
                    method: 'POST',
                    body: deleteData
                })
                .then(response => response.text())

                .then(data => {
                    // console.log(data)
                    window.location.reload();
                })
        })
    }

    const submitdDeleteCategory = document.getElementById("delete-category");

    submitdDeleteCategory.addEventListener("click", function () {

        const catToDelete = document.getElementById("select-category-delete")
        console.log(catToDelete)

        const valueSelect = catToDelete.options[catToDelete.selectedIndex].value;
        console.log(valueSelect)

        const deleteData = new FormData();
        deleteData.append("delete-category", valueSelect);
        console.log(deleteData)

        fetch('adminRouteurJs.php', {
                method: 'POST',
                body: deleteData
            })
            .then(response => response.text())

            .then(data => {
                // console.log(data)
                window.location.reload();
            })
    })

    const submitdDeleteColor = document.getElementById("button-delete");

    submitdDeleteColor.addEventListener("click", function () {

        const colorToDelete = document.getElementById("select-delete")
        console.log(colorToDelete)

        const valueSelect = colorToDelete.options[colorToDelete.selectedIndex].value;
        console.log(valueSelect)

        const deleteData = new FormData();
        deleteData.append("delete-color", valueSelect);
        console.log(deleteData)

        fetch('adminRouteurJs.php', {
                method: 'POST',
                body: deleteData
            })
            .then(response => response.text())

            .then(data => {
                // console.log(data)
                window.location.reload();
            })
    })

    const submitdDeleteMat = document.getElementById("delete-mat");

    submitdDeleteMat.addEventListener("click", function () {

        const matToDelete = document.getElementById("mat-delete")
        console.log(matToDelete)

        const valueSelect = matToDelete.options[matToDelete.selectedIndex].value;
        console.log(valueSelect)

        const deleteData = new FormData();
        deleteData.append("delete-material", valueSelect);


        console.log(deleteData)

        fetch('adminRouteurJs.php', {
                method: 'POST',
                body: deleteData
            })
            .then(response => response.text())

            .then(data => {
                // console.log(data)
                window.location.reload();
            })
    })

    // const UpdateCat = document.getElementById("update-cat");

    // UpdateCat.addEventListener("click", function () {

    //     const catToupdate = document.getElementById("name-cat")
    //     console.log(catToupdate.value)
    //     const idUpdate = document.getElementById("update-cat")
    //     const updateData = new FormData();
    //     updateData.append("update-category", catToupdate.value);
    //     updateData.append("update-category-id", idUpdate.value);
    //     console.log(updateData)

    //     fetch('adminRouteurJs.php', {
    //             method: 'POST',
    //             body: updateData
    //         })
    //         .then(response => response.text())

    //         .then(data => {
    //             // console.log(data)
    //             window.location.reload();
    //         })
    // })

    const deleteBody = document.getElementsByName("delete-body");

    for (let z = 0; z < deleteBody.length; z++) {

        // console.log(deleteRobot[z].value)
        deleteBody[z].addEventListener("click", function () {

            const idBody = deleteBody[z].value
            console.log(idBody)

            const deleteData = new FormData();
            deleteData.append("delete-body", idBody);
            // console.log(deleteData)

            fetch('adminRouteurJs.php', {
                    method: 'POST',
                    body: deleteData
                })
                .then(response => response.text())

                .then(data => {
                    // console.log(data)
                    window.location.reload();
                })
        })
    }

    const submitRobot = document.getElementById("submit-robot");

    submitRobot.addEventListener("click", () => {

        var inputsHead = document.getElementsByName("radio-head");

        inputsHead.forEach(function (radio) {
            // console.log(radio)

            if (radio.checked) {

                headId = radio.value
            }

            // console.log(radio.value + " is not checked");
        });

        var inputsBody = document.getElementsByName("radio-body");

        inputsBody.forEach(function (radio) {
            // console.log(radio)

            if (radio.checked) {

                bodyId = radio.value
            }

            // console.log(radio.value + " is not checked");
        });
        console.log(headId)
        console.log(bodyId)

        const getCategories = document.getElementById("categorieNewRobot");
        const nameRobot = document.getElementById("name-robot");
        const dataCategorie = new FormData();
        dataCategorie.append("categorie-robot", getCategories.value);
        dataCategorie.append("submit-robot", submitRobot.value);
        dataCategorie.append("name-robot", nameRobot.value);
        dataCategorie.append("head-robot", headId);
        dataCategorie.append("body-robot", bodyId);

        fetch('adminRouteurJs.php', {
                method: 'POST',
                body: dataCategorie
            })
            .then(response => response.text())
            .then(body => {
                // console.log(body)
                console.log(dataCategorie)
                window.location.reload();
            })

    });



})