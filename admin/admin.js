document.addEventListener("DOMContentLoaded", () => {

    var buttonColor = document.getElementById("select_color_")
    var buttonColorClass = document.getElementsByClassName("test")
    var divParent = document.getElementById("divParent")
    console.log(buttonColor)
    var url = 'adminRouteurJs.php';

    for (let i = 0; i < buttonColorClass.length; i++) {

        buttonColorClass[i].addEventListener("click", function () {

            var idButton = buttonColorClass[i].id
            console.log(idButton.substring(13))

            const params =

                idButton.substring(13);

            var myHeaders = new Headers();
            myHeaders.append(
                'Accept', 'application/json',
                'Content-Type', 'application/json',
                'Access-Control-Allow-Origin', '*');


            var data = new FormData();
            data.append("select_color", params);

            fetch('adminRouteurJs.php', {
                    method: 'POST',
                    body: data
                })
                .then(response => response.json())
                .then(body => console.log(body));

        });
    }

    var buttonMaterialClass = document.getElementsByClassName("mat_robots")

    console.log(buttonMaterialClass)

    for (let x = 0; x < buttonMaterialClass.length; x++) {

        buttonMaterialClass[x].addEventListener("click", function () {

            var idButtonMat = buttonMaterialClass[x].id
            console.log(idButtonMat.substring(13))

            const paramsMat =

                idButtonMat.substring(11);

            // console.log(paramsMat)
            var myHeadersMat = new Headers();
            myHeadersMat.append(
                'Accept', 'application/json',
                'Content-Type', 'application/json',
                'Access-Control-Allow-Origin', '*');


            var dataMat = new FormData();
            dataMat.append("select_mat", paramsMat);

            fetch('adminRouteurJs.php', {
                    method: 'POST',
                    body: dataMat
                })
                .then(response => response.json())

                .then(body => {
                    console.log(body)
                    var divParent = document.getElementById("divParent")
                    divParent.innerHTML = body
                });

        });
    }


})