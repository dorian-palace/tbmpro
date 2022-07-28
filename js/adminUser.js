document.addEventListener("DOMContentLoaded", () => {

    const submitUpdate = document.getElementById("submit-update-user");

    console.log(submitUpdate);

    submitUpdate.addEventListener("click", function () {

        const name = document.getElementsByName("name");
        const surname = document.getElementsByName("surnameUser");
        const email = document.getElementsByName("mailUser");
        const login = document.getElementsByName("loginUser");
        const role = document.getElementsByName("id_role");

        const formUpdate = new FormData();
        formUpdate.append("name", name.value);
        formUpdate.append("surname", surname.value);
        formUpdate.append("email", email.value);
        formUpdate.append("login", login.value);
        formUpdate.append("role", role.value);

        fetch("UserTraitement.php", {
            method: "POST",
            body: formUpdate
        })
        .then(response => response.json())
        .then(data => {
            console.log(data)
        })

    })

})