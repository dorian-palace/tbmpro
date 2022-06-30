document.addEventListener("DOMContentLoaded", () => {

    const buttonColorClass = document.getElementsByClassName("test");
    for (let i = 0; i < buttonColorClass.length; i++) {

        buttonColorClass[i].addEventListener("click", function () {

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
                    const resultColor = dataColor.co
                    console.log(resultColor)
                });

        });
    }

    const buttonMaterialClass = document.getElementsByClassName("mat_robots")

    for (let x = 0; x < buttonMaterialClass.length; x++) {

        buttonMaterialClass[x].addEventListener("click", function () {

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
                    console.log(mydata)
                    const resDAta = mydata.mat;
                    console.log(resDAta)

                    let images = '';

                    for (y = 0; y < resDAta.length; ++y) {

                        images = resDAta[y].innerHTML +'<img src="../assets/' + resDAta[y].name + '">';

                        ///fghjk

                        console.log(resDAta[y])
                        // images += '<img src="./assets/ ' + resDAta[y]['name'] + '" alt="' + resDAta[y]['name'] + '" >';
                    }
                    document.getElementById('container').innerHTML = images;
                });
        });
    }
})