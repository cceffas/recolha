
const SCREEN = document.getElementById("screen")
const LOAD_SCREEN = document.getElementById("loander")
const popup_message = document.getElementById('popup-message')
const popup_close = document.getElementById('popup-close')
const main_menu = document.getElementById("menu");


const url = "/recolha/"

async function apiRequest($url) {


    let request = await fetch($url)


    if (!request.ok) return "error";


    response = await request.text()



    SCREEN.innerHTML = response
    LOAD_SCREEN.classList.replace("flex", "hidden")

}

if (popup_message) {

    popup_close.addEventListener("click", () => popup_message.remove())
}



document.addEventListener("DOMContentLoaded", function () {

    if (LOAD_SCREEN != null) {

        setInterval(() => LOAD_SCREEN.classList.replace("flex", "hidden"), 1000)

    }

})

function menuToggle(id) {

    let element = document.getElementById(id)

    if (element != null) {

        element.classList.toggle('hidden')

    }
}

function showModal(id) {


    const element = document.getElementById(id)

    element.classList.replace('hidden', 'flex')


}
function closeModal(id) {

    const element = document.getElementById(id)
    element.classList.replace('flex', 'hidden')
}
function startMenu() {

    if (main_menu.classList.contains("hidden")) {

        main_menu.classList.replace("hidden", "flex")
        main_menu.classList.replace("animate-out", "animate-enter")

    }
    else {

        main_menu.classList.replace("flex", "hidden")
        main_menu.classList.replace("animate-enter", "animate-out")

    }



}

function sendDuplicate(id) {


    let btn_submit = document.getElementById(id)
    btn_submit.classList.add("cursor-wait")

    addEventListener("submit", () => btn_submit.setAttribute("disabled", 'true'))

}