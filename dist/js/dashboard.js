const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".search-box"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text");


toggle.addEventListener("click" , () =>{
    sidebar.classList.toggle("close");
})

// Dark mode toggle
const darkToggle = document.getElementById('dark-toggle');
const html = document.querySelector('html');

darkToggle.addEventListener('click', function() {
    if (darkToggle.checked) {
        html.classList.add('dark');
        localStorage.theme = 'dark';
    }else {
        html.classList.remove('dark');
        localStorage.theme = 'light';
    }
});

// pindahkan posisi toggle sesuai mode

if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    darkToggle.checked = true;
} else {
    darkToggle.checked = false;
}

if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark')
} else {
    document.documentElement.classList.remove('dark')
}