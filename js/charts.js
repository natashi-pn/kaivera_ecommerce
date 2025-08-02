const links = document.querySelectorAll('.side_navigation');
const sections = document.querySelectorAll('section');

links.forEach(link => {
    link.addEventListener('click', e => {
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


        const container = document.getElementById('loyalCustomersChart');


        container.innerHTML = '';


        const table = document.createElement('table');
        table.style.width = '100%';
        table.style.borderCollapse = 'collapse';
        table.style.marginTop = '20px';


        table.innerHTML = `
            <thead>
                <tr style="color: white; border-bottom : 1px solid #9e9e9e2e;">
                    <th style="padding: 15px 10px;">Customer</th>
                    <th style="padding: 15px 10px;">Total Orders</th>
                </tr>
            </thead>
            <tbody>
                ${labels.map((label, index) => `
                    <tr>
                        <td style="padding: 10px; color: silver; border-bottom : 1px solid #9e9e9e2e;">${label}</td>
                        <td style="padding: 10px; color: silver; border-bottom : 1px solid #9e9e9e2e;">${data[index]}</td>
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
            '#6752d2ff', '#6fb0e5ff', '#5eccd6ff', '#e1e1e1ff',
        ];

        new Chart(document.getElementById('paymentMethodsChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: backgroundColors.slice(0, labels.length),
                    borderWidth: 0,
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

// Chart 6

fetch('../dashboard/monthly-yearly-sales.php')
    .then(res => res.json())
    .then(data => {
        const monthlyLabels = Object.keys(data.monthly);
        const monthlyValues = Object.values(data.monthly).map(Number);

        const yearlyLabels = Object.keys(data.yearly);
        const yearlyValues = Object.values(data.yearly).map(Number);

        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [...monthlyLabels, ...yearlyLabels],
                datasets: [
                    {
                        label: 'Monthly Sales (This Year)',
                        data: [...monthlyValues, ...Array(yearlyLabels.length).fill(null)],
                        backgroundColor: '#5c6c83ff'
                    },
                    {
                        label: 'Yearly Sales',
                        data: [...Array(monthlyLabels.length).fill(null), ...yearlyValues],
                        backgroundColor: '#435a8bff'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    x: {
                        ticks: { color: '#a4a4a4ff' },
                        stacked: false
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#b6b6b6ff' }
                    }
                }
            }
        });
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