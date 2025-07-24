const links = document.querySelectorAll('.side_navigation');
const sections = document.querySelectorAll('section');

links.forEach(link => {
    link.addEventListener('click', e => {
        // e.preventDefault();
        const targetId = link.getAttribute('href').substring(1);

        sections.forEach(section => {
            section.classList.remove('active');
        });

        document.getElementById(targetId).classList.add('active');
    });
});

// Chart 1

const ctx = document.getElementById('ordersChart').getContext('2d');

fetch('../dashboard/get_orders_by_day.php')
    .then(response => response.json())
    .then(data => {
        const labels = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Number of Orders',
                    data: data,
                    fill: false,
                    borderColor: '#abbee1',
                    backgroundColor: '#ffffffff',
                    tension: 0.3,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Orders'
                        }
                    }
                }
            }
        });
    });


// Chart 2

const ctxCategory = document.getElementById('categoryOrdersChart').getContext('2d');

fetch('../dashboard/orders_by_category.php')
    .then(response => response.json())
    .then(result => {
        if (result.error) {
            console.error(result.error);
            return;
        }
        const { labels, data } = result;

        new Chart(document.getElementById('categoryOrdersChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Orders',
                    data: data,
                    backgroundColor: ['#5f59a2ff', '#6583c3ff', '#accae0ff'],
                    borderRadius: 12,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Total Orders' }
                    },
                    x: {
                        title: { display: true, text: 'Product Category' }
                    }
                }
            }
        });
    })
    .catch(err => {
        console.error('Failed to load chart data:', err);
    });


// Chart 3

fetch('../dashboard/top_loyal_customers.php')
    .then(response => response.json())
    .then(result => {
        if (result.error) {
            console.error(result.error);
            return;
        }

        const { labels, data } = result;

        // Reference to the container where table will be placed
        const container = document.getElementById('loyalCustomersChart');

        // Clear previous content (in case of re-render)
        container.innerHTML = '';

        // Create table element
        const table = document.createElement('table');
        table.style.width = '100%';
        table.style.borderCollapse = 'collapse';
        table.style.marginTop = '20px';

        // Add basic styling (optional)
        table.innerHTML = `
            <thead>
                <tr style="background-color: #1d2025; color: white;">
                    <th style="padding: 10px;">Customer</th>
                    <th style="padding: 10px;">Total Orders</th>
                </tr>
            </thead>
            <tbody>
                ${labels.map((label, index) => `
                    <tr>
                        <td style="background-color: #2b2f36; padding: 10px; color: silver;">${label}</td>
                        <td style="background-color: #2b2f36; padding: 10px; color: silver;">${data[index]}</td>
                    </tr>
                `).join('')}
            </tbody>
        `;

        container.appendChild(table);
    })
    .catch(err => {
        console.error('Failed to load table data:', err);
    });


// chart 4

fetch('../dashboard/best_selling_products.php')
    .then(response => response.json())
    .then(result => {
        if (result.error) {
            console.error(result.error);
            return;
        }

        const { labels, data } = result;

        new Chart(document.getElementById('bestSellingProductsChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Sold',
                    data: data,
                    backgroundColor: '#6d8db9ff',
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                indexAxis: 'y',
                plugins: {
                    legend: { display: false },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        title: { display: true, text: 'Quantity Sold' }
                    },
                    y: {
                        title: { display: true, text: 'Product' }
                    }
                }
            }
        });
    })
    .catch(err => {
        console.error('Failed to load chart data:', err);
    });


// Chart 5

fetch('../dashboard/payment_methods.php')
    .then(response => response.json())
    .then(result => {
        if (result.error) {
            console.error(result.error);
            return;
        }

        const { labels, data } = result;

        const backgroundColors = [
            '#6752d2ff', '#2196f3', '#255a73ff', '#47be6fff', '#80d783ff', '#00bcd4'
        ];

        new Chart(document.getElementById('paymentMethodsChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: backgroundColors.slice(0, labels.length),
                    borderWidth: 1,
                    borderColor: '#fff',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            label: ctx => {
                                const label = ctx.label || '';
                                const value = ctx.raw || 0;
                                const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                const percent = ((value / total) * 100).toFixed(1);
                                return `${label}: ${value} (${percent}%)`;
                            }
                        }
                    }
                }
            }
        });
    })
    .catch(err => {
        console.error('Failed to load chart data:', err);
    });


// Dashboard Cards

document.addEventListener("DOMContentLoaded", () => {
    fetch('../dashboard/dashboard_summary.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error:', data.error);
                return;
            }

            document.getElementById('summary-customers').textContent = data.customers;
            document.getElementById('summary-orders').textContent = data.orders;
            document.getElementById('summary-reviews').textContent = data.reviews;
            document.getElementById('summary-products').textContent = data.products;
            document.getElementById('summary-discounts').textContent = data.discounts;
            document.getElementById('summary-sales').textContent = data.sales;
        })
        .catch(err => {
            console.error('Failed to fetch dashboard summary:', err);
        });
});
