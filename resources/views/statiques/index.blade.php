@extends('layouts.app')
@section('title', 'Statistiques')
@section('content')
<style>
    .statistics-container {
        background: #fff;
        padding: 5px;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        margin: -20px;
    }

    .page-header {
        text-align: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f0f2f5;
    }

    .page-title {
        color: #2c3e50;
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .quick-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr); 
        gap: 15px; 
        margin-top: -15px;
        margin-bottom: 15px;
    }

    .stat-card {
        background: white;
        padding: 15px;  
        border-radius: 10px; 
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); 
        border-left: 3px solid #023e8a; 
        transition: transform 0.2s ease;
        min-height: 50px; 
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 50px;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
    }
    .stat-icon {
        font-size: 1rem;
        margin-bottom: 10px;
        opacity: 0.9;
    }

    .stat-card.sales .stat-icon { color: #3498db; }
    .stat-card.products .stat-icon { color: #2ecc71; }
    .stat-card.users .stat-icon { color: #9b59b6; }
    .stat-card.revenue .stat-icon { color: #e74c3c; }

    .stat-number {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #2c3e50;
        line-height: 1.2;
    }

    .stat-label {
        color: #6c757d;
        font-size: 0.8rem;
        font-weight: 500;
        margin-top: -15px;
    }

    .stat-change {
        font-size: 0.7rem;
        font-weight: 600;
        margin-top: 0px;
        padding: 3px;
        border-radius: 8px;
        display: inline-block;
    }

    .change-positive {
        background: #e8f5e8;
        color: #27ae60;
    }

    .change-negative {
        background: #ffebee;
        color: #e74c3c;
    }

    /* مخططات - مصغرة */
    .charts-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .chart-card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .chart-title {
        font-size: 1rem;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
    }

    .chart-actions {
        display: flex;
        gap: 8px;
    }

    .chart-btn {
        padding: 4px 8px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        background: white;
        color: #6c757d;
        cursor: pointer;
        font-size: 0.7rem;
        transition: all 0.2s ease;
    }

    .chart-btn:hover {
        background: #f8f9fa;
        border-color: #3498db;
        color: #3498db;
    }

    .chart-container {
        height: 250px;
        position: relative;
    }

    /* جدول الإحصائيات - مصغر */
    .stats-table-section {
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .stats-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
        font-size: 0.85rem;
    }

    .stats-table th {
        background: linear-gradient(135deg, #2c3e50, #34495e);
        color: white;
        padding: 12px 8px;
        text-align: left;
        font-weight: 600;
        border: none;
    }

    .stats-table td {
        padding: 10px 8px;
        border-bottom: 1px solid #f0f2f5;
        vertical-align: middle;
    }

    .stats-table tr:nth-child(even) {
        background-color: #fafafa;
    }

    .stats-table tr:hover {
        background-color: #f8f9fa;
    }

    .progress-bar {
        width: 100%;
        height: 6px;
        background: #ecf0f1;
        border-radius: 3px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        border-radius: 3px;
        transition: width 0.3s ease;
    }

    .progress-sales { background: linear-gradient(90deg, #3498db, #2980b9); }
    .progress-products { background: linear-gradient(90deg, #2ecc71, #27ae60); }
    .progress-users { background: linear-gradient(90deg, #9b59b6, #8e44ad); }

    /* تحديث البيانات */
    .refresh-section {
        text-align: center;
        margin-top: 25px;
    }

    .btn-refresh {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.85rem;
    }

    .btn-refresh:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(52, 152, 219, 0.3);
    }

    /* التحميل */
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    .chart-controls {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }
    
    .chart-type-btn {
        padding: 8px 15px;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .chart-type-btn.active {
        background: #3498db;
        color: white;
        border-color: #3498db;
    }
    
    .chart-info {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-top: 15px;
        font-size: 0.9rem;
    }
    
    .chart-info ul {
        margin: 0;
        padding-left: 20px;
    }
    
    .chart-info li {
        margin-bottom: 5px;
    }
    
    .stats-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }
    
    .summary-card {
        background: white;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        text-align: center;
    }
    
    .summary-value {
        font-size: 1.5rem;
        font-weight: bold;
        color: #2c3e50;
    }
    
    .summary-label {
        font-size: 0.9rem;
        color: #6c757d;
        margin-top: 5px;
    }

    @media (max-width: 1200px) {
        .quick-stats {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
    }

    @media (max-width: 768px) {
        .statistics-container {
            padding: 15px;
        }

        .page-title {
            font-size: 1.5rem;
            flex-direction: column;
            gap: 8px;
        }

        .quick-stats {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .stat-card {
            padding: 15px 12px;
            min-height: 100px;
        }

        .stat-number {
            font-size: 1.3rem;
        }

        .charts-section {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .chart-container {
            height: 200px;
        }

        .chart-card {
            padding: 15px;
        }
    }

    @media (max-width: 480px) {
        .stat-number {
            font-size: 1.2rem;
        }
        
        .chart-container {
            height: 180px;
        }

        .stats-table {
            font-size: 0.8rem;
        }
    }
</style>

<div class="statistics-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-chart-line"></i>
            Dashboard - Statistics
        </h1>
    </div>

    @php
        // حماية البيانات الفارغة
        $totalMenProducts = $totalMenProducts ?? 0;
        $totalWomenProducts = $totalWomenProducts ?? 0;
        $totalShopProducts = $totalShopProducts ?? 0;

        $totalMenStock = $totalMenStock ?? 0;
        $totalWomenStock = $totalWomenStock ?? 0;
        $totalShopStock = $totalShopStock ?? 0;

        $totalValidatedOrders = $totalValidatedOrders ?? 0;
        $totalUsers = $totalUsers ?? 0;
        $revueTotal = $revueTotal ?? 0;
        $PercentageVentes = $PercentageVentes ?? 0;
        $PercentageStock = $PercentageStock ?? 0;
        $PercentageUsers = $PercentageUsers ?? 0;
        $revenueChange = $revenueChange ?? 0;

        $totalProductsStock = $totalMenStock + $totalWomenStock + $totalShopStock;
        $totalProducts = $totalMenProducts + $totalWomenProducts + $totalShopProducts;

        $totalOrders = $totalOrders ?? 0;
        $totalInventoryItems = $totalInventoryItems ?? 0;

        $salesByCategory = $salesByCategory ?? ['Hommes'=>0,'Femmes'=>0,'Shop'=>0];
    @endphp

    <!-- Quick Stats -->
    <div class="quick-stats">
        @php
            $stats = [
                ['label' => 'Total Sales', 'number' => $totalValidatedOrders, 'percentage' => $PercentageVentes],
                ['label' => 'Products in Stock', 'number' => $totalProductsStock, 'percentage' => $PercentageStock],
                ['label' => 'Active Users', 'number' => $totalUsers, 'percentage' => $PercentageUsers],
                ['label' => 'Total Revenue', 'number' => $revueTotal.' DH', 'percentage' => $revenueChange],
            ];
        @endphp

        @foreach ($stats as $stat)
            @php
                $isPositive = $stat['percentage'] >= 0;
            @endphp
            <div class="stat-card">
                <div class="stat-icon"></div>
                <div class="stat-number">{{ $stat['number'] }}</div>
                <div class="stat-label">{{ $stat['label'] }}</div>
                <div class="stat-change {{ $isPositive ? 'change-positive' : 'change-negative' }}">
                    <i class="fas {{ $isPositive ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i> {{ abs($stat['percentage']) }}%
                </div>
            </div>
        @endforeach
    </div>

    <!-- Charts Section -->
    <div class="charts-section">
        <!-- Monthly Sales Chart -->
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">Monthly Sales</h3>
                <div class="chart-actions">
                    <button class="chart-btn" onclick="updateSalesChart('month')">Month</button>
                    <button class="chart-btn" onclick="updateSalesChart('year')">Year</button>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Product Distribution Chart -->
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">Product Distribution</h3>
                <div class="chart-controls">
                    <button class="chart-type-btn active" onclick="showProductsChart('categories', event)">By Categories</button>
                    <!-- <button class="chart-type-btn" onclick="showProductsChart('sales', event)">By Sales</button> -->
                    <button class="chart-type-btn" onclick="showProductsChart('stock', event)">By Stock</button>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="productsChart"></canvas>
            </div>
            <div class="chart-info" id="productsInfo">
                @php
                    $totalProductsSafe = $totalProducts > 0 ? $totalProducts : 1; // لتجنب القسمة على صفر
                @endphp
                <p><strong>Product distribution by category:</strong></p>
                <ul>
                    <li>Men: {{ $totalMenProducts }} products ({{ round(($totalMenProducts/$totalProductsSafe)*100,1) }}%)</li>
                    <li>Women: {{ $totalWomenProducts }} products ({{ round(($totalWomenProducts/$totalProductsSafe)*100,1) }}%)</li>
                    <li>Shop: {{ $totalShopProducts }} products ({{ round(($totalShopProducts/$totalProductsSafe)*100,1) }}%)</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Additional Stats -->
    <div class="stats-summary">
        <div class="summary-card">
            <div class="summary-value">{{ $totalOrders }}</div>
            <div class="summary-label">Total Orders</div>
        </div>
        <div class="summary-card">
            <div class="summary-value">{{ $totalMenProducts }}</div>
            <div class="summary-label">Men Products</div>
        </div>
        <div class="summary-card">
            <div class="summary-value">{{ $totalWomenProducts }}</div>
            <div class="summary-label">Women Products</div>
        </div>
        <div class="summary-card">
            <div class="summary-value">{{ $totalInventoryItems }}</div>
            <div class="summary-label">Inventory Items</div>
        </div>
    </div>

    <!-- Stats Table -->
    <div class="stats-table-section">
        <h3 class="section-title">
            <i class="fas fa-table"></i>
            Detailed Statistics
        </h3>
        <table class="stats-table">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Products</th>
                    <th>Percentage</th>
                    <th>Sales (DH)</th>
                    <th>Performance</th>
                </tr>
            </thead>
            <tbody>
                @php $totalProductsSafe = $totalProducts > 0 ? $totalProducts : 1; @endphp
                <tr>
                    <td><i class="fas fa-male"></i> Men</td>
                    <td>{{ $totalMenProducts }}</td>
                    <td>{{ round(($totalMenProducts/$totalProductsSafe)*100,1) }}%</td>
                    <td>{{ number_format($salesByCategory['Hommes'] ?? 0) }} DH</td>
                    <td>
                        <div class="progress-bar">
                            <div class="progress-fill progress-sales" style="width: {{ round(($totalMenProducts/$totalProductsSafe)*100,1) }}%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><i class="fas fa-female"></i> Women</td>
                    <td>{{ $totalWomenProducts }}</td>
                    <td>{{ round(($totalWomenProducts/$totalProductsSafe)*100,1) }}%</td>
                    <td>{{ number_format($salesByCategory['Femmes'] ?? 0) }} DH</td>
                    <td>
                        <div class="progress-bar">
                            <div class="progress-fill progress-products" style="width: {{ round(($totalWomenProducts/$totalProductsSafe)*100,1) }}%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><i class="fas fa-store"></i> Shop</td>
                    <td>{{ $totalShopProducts }}</td>
                    <td>{{ round(($totalShopProducts/$totalProductsSafe)*100,1) }}%</td>
                    <td>{{ number_format($salesByCategory['Shop'] ?? 0) }} DH</td>
                    <td>
                        <div class="progress-bar">
                            <div class="progress-fill progress-users" style="width: {{ round(($totalShopProducts/$totalProductsSafe)*100,1) }}%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>{{ $totalProducts }}</strong></td>
                    <td><strong>100%</strong></td>
                    <td><strong>{{ number_format(array_sum($salesByCategory)) }} DH</strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Refresh Button -->
    <div class="refresh-section">
        <button class="btn-refresh" id="refreshStats">
            <i class="fas fa-sync-alt"></i>
            Refresh Statistics
        </button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // حماية بيانات الجافاسكريبت
        const realProductData = {
            labels: ['Men','Women','Shop'],
            data: [{{ $totalMenProducts ?? 0 }}, {{ $totalWomenProducts ?? 0 }}, {{ $totalShopProducts ?? 0 }}],
            salesData: [
                {{ round(($salesByCategory['Hommes'] ?? 0)/1000, 2) }},
                {{ round(($salesByCategory['Femmes'] ?? 0)/1000, 2) }},
                {{ round(($salesByCategory['Shop'] ?? 0)/1000, 2) }}
            ],
            stockData: [{{ $totalMenStock ?? 0 }}, {{ $totalWomenStock ?? 0 }}, {{ $totalShopStock ?? 0 }}]
        };

        const monthlySalesData = @json($monthlySalesData ?? ['labels'=>[], 'data'=>[]]);
        const yearlySalesData = @json($yearlySalesData ?? ['labels'=>[], 'data'=>[]]);

        let salesChart, productsChart, currentProductsChartType='categories';

        function initSalesChart() {
            const salesCtx = document.getElementById('salesChart');
            if(!salesCtx) return;
            
            if(salesChart) salesChart.destroy();
            
            salesChart = new Chart(salesCtx, {
                type:'line',
                data:{
                    labels: monthlySalesData.labels || [],
                    datasets:[{
                        label:'Revenue (K DH)',
                        data: monthlySalesData.data || [],
                        borderColor:'#3498db',
                        backgroundColor:'rgba(52,152,219,0.1)',
                        borderWidth:3,
                        fill:true,
                        tension:0.4,
                        pointBackgroundColor:'#3498db',
                        pointBorderColor:'#ffffff',
                        pointBorderWidth:2,
                        pointRadius:4,
                        pointHoverRadius:6
                    }]
                },
                options:{
                    responsive:true, 
                    maintainAspectRatio:false,
                    plugins:{
                        legend:{
                            display:false
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: 'rgba(0,0,0,0.7)',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            borderColor: '#3498db',
                            borderWidth: 1
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return value + 'K DH';
                                }
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'nearest'
                    }
                }
            });
        }

        function initProductsChart(type='categories') {
            const productsCtx = document.getElementById('productsChart');
            if(!productsCtx) return;
            
            if(productsChart) productsChart.destroy();
            
            currentProductsChartType = type;

            let chartData = [], chartType='doughnut', backgroundColor=[];
            let chartTitle = '';

            switch(type){
                case 'sales':
                    chartData = realProductData.salesData;
                    chartType='bar';
                    backgroundColor=['#3498db','#9b59b6','#2ecc71'];
                    chartTitle = 'Sales by category';
                    
                    // تحديث المعلومات المعروضة
                    document.getElementById('productsInfo').innerHTML = `
                        <p><strong>Sales by category (K DH):</strong></p>
                        <ul>
                            <li>Men: ${chartData[0].toFixed(2)}K DH</li>
                            <li>Women: ${chartData[1].toFixed(2)}K DH</li>
                            <li>Shop: ${chartData[2].toFixed(2)}K DH</li>
                        </ul>
                    `;
                    break;
                    
                case 'stock':
                    chartData = realProductData.stockData;
                    chartType='doughnut';
                    backgroundColor=['#07247aff','#b73c9eff','#e74c3c'];
                    chartTitle = 'Stock level by category';
                    
                    document.getElementById('productsInfo').innerHTML = `
                        <p><strong>Stock level by category:</strong></p>
                        <ul>
                            <li>Men: ${chartData[0]} units</li>
                            <li>Women: ${chartData[1]} units</li>
                            <li>Shop: ${chartData[2]} units</li>
                        </ul>
                    `;
                    break;
                    
                default:
                    chartData = realProductData.data;
                    chartType='doughnut';
                    backgroundColor=['#07247aff','#b73c9eff','#2ecc71'];
                    chartTitle = 'Product distribution by category';
                    
                    document.getElementById('productsInfo').innerHTML = `
                        <p><strong>Product distribution by category:</strong></p>
                        <ul>
                            <li>Men: ${chartData[0]} products</li>
                            <li>Women: ${chartData[1]} products</li>
                            <li>Shop: ${chartData[2]} products</li>
                        </ul>
                    `;
            }

            // إعدادات المخطط
            const chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: chartType === 'doughnut' ? 'bottom' : 'top',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'rgba(0,0,0,0.7)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#3498db',
                        borderWidth: 1
                    }
                }
            };

            // إعدادات إضافية للمخطط الشريطي
            if(chartType === 'bar') {
                chartOptions.scales = {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                return value + 'K DH';
                            }
                        },
                        title: {
                            display: true,
                            text: 'Sales (K DH)',
                            color: '#666'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                };
                
                chartOptions.plugins.legend.display = false;
            } else {
                chartOptions.plugins.tooltip = {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (type === 'sales') {
                                label += context.parsed.toFixed(2) + 'K DH';
                            } else {
                                label += context.parsed;
                            }
                            return label;
                        }
                    }
                };
            }

            productsChart = new Chart(productsCtx, {
                type: chartType,
                data: {
                    labels: realProductData.labels,
                    datasets: [{
                        data: chartData,
                        backgroundColor: backgroundColor,
                        borderColor: '#fff',
                        borderWidth: 2,
                        hoverBackgroundColor: backgroundColor.map(color => {
                            // جعل الألوان أفتح عند التمرير
                            return color.replace(')', ', 0.8)').replace('ff', '');
                        }),
                        borderRadius: chartType === 'bar' ? 5 : 0,
                        borderSkipped: false
                    }]
                },
                options: chartOptions
            });
        }

        // دالة لتغيير نوع مخطط المنتجات
        window.showProductsChart = function(type, event) {
            document.querySelectorAll('.chart-type-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            initProductsChart(type);
        };

        // دالة لتحديث مخطط المبيعات
        function updateSalesChart(type) {
            if(!salesChart) return;
            
            if(type === 'month') {
                salesChart.data.labels = monthlySalesData.labels || [];
                salesChart.data.datasets[0].data = monthlySalesData.data || [];
                salesChart.data.datasets[0].label = 'Monthly Revenue (K DH)';
            } else {
                salesChart.data.labels = yearlySalesData.labels || [];
                salesChart.data.datasets[0].data = yearlySalesData.data || [];
                salesChart.data.datasets[0].label = 'Yearly Revenue (K DH)';
            }
            salesChart.update();
        }

        // إضافة مستمعات الأحداث لأزرار مخطط المبيعات
        document.querySelectorAll('.chart-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const type = this.textContent.trim().toLowerCase();
                updateSalesChart(type);
                document.querySelectorAll('.chart-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // زر تحديث الإحصائيات
        const refreshBtn = document.getElementById('refreshStats');
        if(refreshBtn) {
            refreshBtn.addEventListener('click', function() {
                const container = document.querySelector('.statistics-container');
                const btn = this;
                
                // إضافة تأثير التحميل
                container.classList.add('loading');
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
                
                setTimeout(() => {
                    fetch('/statistics/refresh')
                        .then(res => res.json())
                        .then(data => {
                            // تحديث الإحصائيات السريعة
                            document.querySelectorAll('.stat-number').forEach((el, index) => {
                                if(index === 0) el.textContent = data.totalValidatedOrders ?? 0;
                                if(index === 1) el.textContent = data.totalProductsStock ?? 0;
                                if(index === 2) el.textContent = data.totalUsers ?? 0;
                                if(index === 3) el.textContent = (data.revueTotal ?? 0) + ' DH';
                            });
                            
                            // إعادة تحميل المخططات إذا كانت البيانات تحتوي على معلومات جديدة
                            if(data.monthlySalesData || data.yearlySalesData) {
                                initSalesChart();
                            }
                            
                            if(data.salesByCategory) {
                                // إعادة تحميل مخطط المنتجات
                                initProductsChart(currentProductsChartType);
                            }
                            
                            container.classList.remove('loading');
                            btn.disabled = false;
                            btn.innerHTML = '<i class="fas fa-sync-alt"></i> Refresh Statistics';
                            
                            // إشعار النجاح
                            showNotification('Statistics updated successfully!', 'success');
                        })
                        .catch(err => {
                            console.error('Error refreshing statistics:', err);
                            container.classList.remove('loading');
                            btn.disabled = false;
                            btn.innerHTML = '<i class="fas fa-sync-alt"></i> Refresh Statistics';
                            showNotification('Error updating statistics', 'error');
                        });
                }, 1000);
            });
        }

        // دالة لعرض الإشعارات
        function showNotification(message, type = 'info') {
            // يمكنك استخدام مكتبة إشعارات أو إنشاء إشعار مخصص
            alert(message); // بسيط للإشعارات
            
            // أو يمكنك استخدام:
            /*
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `
                <span>${message}</span>
                <button onclick="this.parentElement.remove()">&times;</button>
            `;
            document.body.appendChild(notification);
            setTimeout(() => notification.remove(), 3000);
            */
        }

        // تهيئة المخططات
        initSalesChart();
        initProductsChart('categories');

        // إضافة class active للزر الأول في مخطط المبيعات
        document.querySelector('.chart-btn:first-child')?.classList.add('active');
        document.querySelector('.chart-type-btn:first-child')?.classList.add('active');
    });
</script>

@endsection