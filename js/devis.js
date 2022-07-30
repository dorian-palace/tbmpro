document.addEventListener("DOMContentLoaded", () => {

    function capture() {
        const captureElement = document.querySelector('#container');

        html2canvas(captureElement)
            .then(canvas => {
                canvas.style.display = 'none'
                document.body.appendChild(canvas)
                return canvas
            })
            .then(canvas => {
                const image = canvas.toDataURL('image/png').replace('image/png', 'image/octet-stream')
                const a = document.createElement('a')
                a.setAttribute('download', 'mon-devis.png')
                a.setAttribute('href', image)
                a.click()
                canvas.remove()
            })
    }

    const btn = document.querySelector('#screen-shot-devis');
    btn.addEventListener('click', capture)

})