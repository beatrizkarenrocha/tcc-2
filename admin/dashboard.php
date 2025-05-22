<?php
// index-painel.php
include '../includes/sidebar.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PowerPC Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color: #3a7bd5;
            --secondary-color: #00d2ff;
            --success-color: #28a745;
            --info-color: #17a2b8;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --card-hover: 0 8px 30px rgba(0, 0, 0, 0.12);
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Poppins', sans-serif;
        }
        
        .main-content {
            padding: 2rem;
            margin-left: 0px;
            transition: all 0.4s;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .page-header h1 {
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }
        
        .stats-card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-hover);
        }
        
        .stats-card .card-body {
            padding: 1.5rem;
            position: relative;
            z-index: 2;
        }
        
        .stats-card .card-icon {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 2.5rem;
            opacity: 0.2;
            color: inherit;
        }
        
        .stats-card .card-title {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }
        
        .stats-card .card-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
        
        .stats-card .card-change {
            font-size: 0.85rem;
            display: flex;
            align-items: center;
        }
        
        .stats-card .card-change.positive {
            color: var(--success-color);
        }
        
        .stats-card .card-change.negative {
            color: var(--danger-color);
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
            padding: 1.25rem 1.5rem;
            border-radius: 12px 12px 0 0 !important;
        }
        
        .chart-container {
            position: relative;
            height: 300px;
            padding: 1rem;
        }
        
        .btn-action {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            box-shadow: 0 4px 15px rgba(58, 123, 213, 0.3);
            transition: all 0.3s;
        }
        
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(58, 123, 213, 0.4);
            color: white;
        }
        
        /* Cores específicas para cada card */
        .card-products {
            background-color: white;
            border-left: 4px solid var(--primary-color);
        }
        
        .card-users {
            background-color: white;
            border-left: 4px solid var(--success-color);
        }
        
        .card-orders {
            background-color: white;
            border-left: 4px solid var(--warning-color);
        }
        
        .card-sales {
            background-color: white;
            border-left: 4px solid var(--danger-color);
        }
        
        /* Responsividade */
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="container-fluid px-4">
            <div class="page-header">
                <h1>Dashboard</h1>
                <div class="last-update">Última atualização: <?php echo date('d/m/Y H:i'); ?></div>
            </div>
            
            <div class="row">
                <!-- Card Produtos -->
                <div class="col-xl-3 col-md-6">
                    <div class="stats-card card-products">
                        <div class="card-body">
                            <i class="fas fa-boxes card-icon"></i>
                            <div class="card-title">Produtos</div>
                            <div class="card-value">0</div>
                            <div class="card-change">
                                <i class="fas fa-arrow-up"></i> 0% este mês
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Usuários -->
                <div class="col-xl-3 col-md-6">
                    <div class="stats-card card-users">
                        <div class="card-body">
                            <i class="fas fa-users card-icon"></i>
                            <div class="card-title">Usuários</div>
                            <div class="card-value">8</div>
                            <div class="card-change positive">
                                <i class="fas fa-arrow-up"></i> ...
                            </div>
                            <div class="text-center mt-3">
                                <a href="../public/cadastro_new_V2.php" class="btn btn-action">
                                    <i class="fas fa-user-plus"></i> Cadastrar Usuário
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Pedidos -->
                <div class="col-xl-3 col-md-6">
                    <div class="stats-card card-orders">
                        <div class="card-body">
                            <i class="fas fa-shopping-cart card-icon"></i>
                            <div class="card-title">Pedidos</div>
                            <div class="card-value">0</div>
                            <div class="card-change negative">
                                <i class="fas fa-arrow-down"></i> 0% este mês
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Vendas -->
                <div class="col-xl-3 col-md-6">
                    <div class="stats-card card-sales">
                        <div class="card-body">
                            <i class="fas fa-chart-line card-icon"></i>
                            <div class="card-title">Vendas (R$)</div>
                            <div class="card-value">R$ 0,00</div>
                            <div class="card-change">
                                <i class="fas fa-equals"></i> Sem variação
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos e informações -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Vendas Mensais</span>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                    Este ano
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Este ano</a></li>
                                    <li><a class="dropdown-item" href="#">Últimos 6 meses</a></li>
                                    <li><a class="dropdown-item" href="#">Últimos 3 meses</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="vendasMensaisChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status dos pedidos -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            Status dos Pedidos
                        </div>
                        <div class="card-body">
                            <div class="text-center py-4">
                                <i class="fas fa-shopping-bag" style="font-size: 3rem; color: #e9ecef;"></i>
                                <p class="mt-3 text-muted">Nenhum pedido registrado.</p>
                                <a href="#" class="btn btn-action mt-2">
                                    <i class="fas fa-plus"></i> Novo Pedido
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Últimas atividades -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Últimas Atividades
                        </div>
                        <div class="card-body">
                            <div class="activity-item d-flex align-items-start mb-3">
                                <div class="activity-icon bg-primary bg-opacity-10 text-primary p-3 rounded-circle me-3">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Novo usuário registrado</h6>
                                    <p class="text-muted mb-0">...</p>
                                    <small class="text-muted">....</small>
                                </div>
                            </div>
                            <div class="activity-item d-flex align-items-start mb-3">
                                <div class="activity-icon bg-warning bg-opacity-10 text-warning p-3 rounded-circle me-3">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Atualização necessária</h6>
                                    <p class="text-muted mb-0">....</p>
                                    <small class="text-muted">....</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script do gráfico -->
    <script>
    const ctx = document.getElementById('vendasMensaisChart').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(58, 123, 213, 0.8)');
    gradient.addColorStop(1, 'rgba(0, 210, 255, 0.2)');
    
    const vendasChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            datasets: [{
                label: 'Vendas Mensais (R$)',
                data: [1200, 1900, 1500, 2000, 1800, 2200, 2400, 2100, 2300, 2500, 2700, 3000],
                backgroundColor: gradient,
                borderColor: 'rgba(58, 123, 213, 1)',
                borderWidth: 0,
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#2c3e50',
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 12
                    },
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: false
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    beginAtZero: true
                }
            }
        }
    });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>