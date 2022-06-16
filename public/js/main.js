const chart = document.querySelector("#chart").getContext('2d');
//  create a new chart instance
new Chart(chart, {
    type: 'line',
    data: {
        labels: [1,3,5,7,9,11,13,15,17,19,21,23,25,27,29,31],
        datasets: [
        {
            label: 'Income',
            data: [40000, 12000,230000,239999,120000,50000,0,1200,0,1000,14000,40000,0,0,150000,0],
            borderColor: 'red',
            borderWidth: 2
        },
        {
            label: 'Expenses',
            data: [-40000, -12000,-230000,-239999,-120000,-50000,0,0,0,-1000,0,0,-150000,0,0,0],
            borderColor: 'blue',
            borderWidth: 2
        }
        ]
    },
    options: {
        responsive: true
    }
})

// show or hide sidebar
const menuBtn = document.querySelector('#menu-btn');
const closeBtn = document.querySelector('#close-btn');
const sidebar = document.querySelector('aside');

menuBtn.addEventListener('click', ()=>{
    sidebar.style.display = 'block';
})
closeBtn.addEventListener('click', ()=>{
    sidebar.style.display = 'none';
})

// change theme
const themeBtn = document.querySelector('.theme-btn');

themeBtn.addEventListener('click', ()=>{
    document.body.classList.toggle('dark-theme');

    themeBtn.querySelector('span:first-child').classList.toggle('active');

            
    themeBtn.querySelector('span:last-child').classList.toggle('active');
})