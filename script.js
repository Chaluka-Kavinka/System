// Sample event data
const events = [
    {
        id: 1,
        title: "Central Park Cleanup",
        date: "June 15, 2023 • 9:00 AM - 12:00 PM",
        image: "https://source.unsplash.com/random/600x400/?parkcleanup",
        description: "Help keep our beloved Central Park clean and beautiful for everyone to enjoy.",
        volunteersNeeded: 20,
        volunteersSignedUp: 15
    },
    {
        id: 2,
        title: "Food Bank Assistance",
        date: "June 18, 2023 • 10:00 AM - 2:00 PM",
        image: "https://source.unsplash.com/random/600x400/?foodbank",
        description: "Help sort and package food donations for distribution to families in need.",
        volunteersNeeded: 15,
        volunteersSignedUp: 10
    },
    {
        id: 3,
        title: "After School Tutoring",
        date: "June 20, 2023 • 3:00 PM - 5:00 PM",
        image: "https://source.unsplash.com/random/600x400/?tutoring",
        description: "Provide academic support and mentorship to elementary school students.",
        volunteersNeeded: 10,
        volunteersSignedUp: 8
    }
];

// DOM Elements
const eventsContainer = document.getElementById('eventsContainer');
const loginBtn = document.getElementById('loginBtn');

const loginModal = document.getElementById('loginModal');

const closeButtons = document.querySelectorAll('.close');
const loginForm = document.getElementById('loginForm');


// Display events on page load
document.addEventListener('DOMContentLoaded', function() {
    displayEvents();
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
});

// Display events in the events container
function displayEvents() {
    eventsContainer.innerHTML = '';
    
    events.forEach(event => {
        const eventCard = document.createElement('div');
        eventCard.classList.add('event-card');
        
        eventCard.innerHTML = `
            <div class="event-image" style="background-image: url('${event.image}');"></div>
            <div class="event-details">
                <div class="event-date">${event.date}</div>
                <h3>${event.title}</h3>
                <p>${event.description}</p>
                <div class="event-stats">
                    <span>${event.volunteersNeeded} volunteers needed</span>
                    <span>${event.volunteersSignedUp} signed up</span>
                </div>
                <a href="#" class="btn">Sign Up</a>
            </div>
        `;
        
        eventsContainer.appendChild(eventCard);
    });
}

// Modal functionality
loginBtn.addEventListener('click', function(e) {
    e.preventDefault();
    loginModal.style.display = 'block';
});



closeButtons.forEach(button => {
    button.addEventListener('click', function() {
        loginModal.style.display = 'none';
       
    });
});

window.addEventListener('click', function(e) {
    if (e.target === loginModal) {
        loginModal.style.display = 'none';
    }
    
});

// Form submissions
loginForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const userType = document.getElementById('loginUserType').value;

    console.log('Login attempt:', { email, password, userType });
    alert('Login successful! Redirecting...');

    loginModal.style.display = 'none';

    if (userType === 'volunteer') {
        window.location.href = 'volunteer.html';
    } else if (userType === 'organization') {
        window.location.href = 'organization.html';
    }
});

// Demo button functionality
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn') && e.target.getAttribute('href') === '#') {
        e.preventDefault();
        
    }
});