document.addEventListener("DOMContentLoaded", () => {

    const buttonColorClass = document.getElementsByClassName("filter-color");
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
                    const resultColor = dataColor.colorHeadRobots
                    // console.log(resultColor)

                    let images = '';

                    for (y = 0; y < resultColor.length; ++y) {

                        images = images + '<img id="box-robots-filter" src="../assets/' + resultColor[y].name + '">';
                    }
                    // console.log(images)
                    document.getElementById('box-robots-filter').innerHTML = images;
                });

        });
    }

    const buttonMaterialClass = document.getElementsByClassName("filter-mat")

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
                    // console.log(mydata)
                    const resDAta = mydata.materialHeadRobots;
                    // console.log(resDAta)
                    let images = '';

                    for (y = 0; y < resDAta.length; ++y) {

                        images = images + '<img id="box-robots-filter" src="../assets/' + resDAta[y].name + '">';


                        //function for each images create input type check for each images



                        // let lab = document.getElementById('label')
                        // console.log(lab)
                        // value = images/
                        // for (let index = 0; index < images; index++) {
                        //     const element = images[index];
                        //     console.log(index)
                        //     // label.setAttribute("id", "toto")
                        //     // // let toto = div.append(label);
                        //     // label.innerHTML = images
                        // let div = document.getElementById("container-filter-robot")
                        //     let label = document.createElement("INPUT")
                        //     label.setAttribute("type", "checkbox");

                        //         // .append(`<input type="checkbox" id="" name="interest">`)
                        //         // .append('<label for="interest"></label></div>')
                        //         // //document.getElementById('interest').innerHTML = images

                        //         // .append(`<br>`);

                        // }
                        // for (var value of images) {
                        // console.log(value)
                        // console.table(images)
                        // $(images).each(function () {
                        // });
                        // $inner = document.getElementsByName("interest").innerHTML = images;
                        // }

                        // console.log(resDAta[y].id)

                        // function checkbox() {
                        //     const checkbox = document.createElement("input");
                        //     checkbox.type = "checkbox";
                        //     checkbox.name = "checkbox";
                        //     checkbox.value = resDAta[y].id;
                        //     checkbox.id = "checkbox";
                        //     document.getElementById("box-robots-filter").appendChild(checkbox);
                        // }
                        // checkbox();
                        // document.getElementById('box-robots-filter').innerHTML = images;


                        const newLabel = document.createElement("label");
                        newLabel.setAttribute("for", 'checkbox');
                        newLabel.innerHTML = images;

                        const newCheckbox = document.createElement("input");
                        newCheckbox.setAttribute("type", 'checkbox');
                        newCheckbox.setAttribute("id", 'checkbox');
                        newCheckbox.setAttribute("value", resDAta[y].id);

                        document.body.appendChild(newLabel);
                        document.body.appendChild(newCheckbox);

                    }

                    // let check = document.getElementById('checkbox-filter-robots')
                    // check.img
                    // document.getElementById("placehere").appendChild("elem");
                    // let checkbox = document.getElementById("checkbox-filter-robots");
                    // var p = document.createElement("INPUT");
                    // p.setAttribute("type", "checkbox");
                    // let input = document.body.appendChild(p);
                    // input.innerHTML = images;


                    // var checkbox = document.createElement('input');
                    //     checkbox.type = 'checkbox';
                    //     checkbox.id = 'car';
                    //     checkbox.name = 'interest';
                    //     checkbox.value = innerHTML = images.id;

                    //     var label = document.createElement('label')
                    //     label.htmlFor = 'car';
                    //     label.appendChild(document.createTextNode('Car'));

                    //     var br = document.createElement('br');

                    //     var container = document.getElementById('container');
                    //     container.appendChild(checkbox);
                    //     container.appendChild(label);
                    //     container.appendChild(br);
                });

            // elem = innerHTML.images;
        });
    }
})