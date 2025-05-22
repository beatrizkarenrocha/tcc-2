<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>PowerPC Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --sidebar-bg: #1a1f2b;
            --sidebar-accent: #3a7bd5;
            --sidebar-text: #e0e5ec;
            --sidebar-hover: #2a3244;
            --sidebar-active: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            height: 100vh;
            position: fixed;
            padding: 30px 0;
            box-shadow: 5px 0 30px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
            z-index: 100;
        }
        
        .sidebar:hover {
            box-shadow: 5px 0 30px rgba(0, 0, 0, 0.2);
        }
        
        .sidebar h2 {
            color: white;
            text-align: center;
            margin-bottom: 40px;
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 1px;
            position: relative;
            padding-bottom: 15px;
        }
        
        .sidebar h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: var(--sidebar-accent);
            border-radius: 3px;
        }
        
        .sidebar nav {
            display: flex;
            flex-direction: column;
            padding: 0 20px;
        }
        
        .sidebar a {
            color: var(--sidebar-text);
            text-decoration: none;
            padding: 15px 25px;
            margin: 5px 0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        
        .sidebar a i {
            margin-right: 15px;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }
        
        .sidebar a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 3px;
            height: 100%;
            background: var(--sidebar-accent);
            transform: scaleY(0);
            transition: transform 0.3s, width 0.4s cubic-bezier(1, 0, 0, 1) 0.3s;
        }
        
        .sidebar a:hover {
            background: var(--sidebar-hover);
            transform: translateX(5px);
        }
        
        .sidebar a:hover::before {
            transform: scaleY(1);
        }
        
        .sidebar a.active {
            background: var(--sidebar-active);
            color: white;
            box-shadow: 0 5px 15px rgba(58, 123, 213, 0.3);
        }
        
        .sidebar a.active::before {
            transform: scaleY(1);
            width: 100%;
            opacity: 0.2;
        }
        
        .main-content {
            flex-grow: 1;
            margin-left: 280px;
            padding: 30px;
            transition: all 0.4s;
        }
        
        /* Efeito de notificação */
        .badge-notification {
            position: absolute;
            right: 20px;
            background: #ff4757;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: bold;
        }
        
        /* Responsividade */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                width: 260px;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <aside class="sidebar" >
       
        <h2>PowerPC Admin</h2>
        <nav>
            <a href="dashboard.php" class="active">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
            </a>
            <a href="./usuarios/index-create.php">
                <i class="fas fa-users"></i>
                Usuários
                <span class="badge-notification"></span>
            </a>
            <a href="index-painel.php?page=produtos">
                <i class="fas fa-box-open"></i>
                Produtos
            </a>
            <a href="index-painel.php?page=pedidos">
                <i class="fas fa-shopping-cart"></i>
                Pedidos
                <span class="badge-notification"></span>
            </a>
            <a href="index-painel.php?page=administradores">
                <i class="fas fa-user-shield"></i>
                Administradores
            </a>
            <a href="index-painel.php?page=minha-conta">
                <i class="fas fa-user-cog"></i>
                Minha Conta
            </a>
            <a href="logout.php">
                <i class="fas fa-sign-out-alt"></i>
                Sair
            </a>

        </nav>
    </aside>
    
    <div class="main-content">
        <!-- Conteúdo principal vai aqui -->
        <a href="dashboard.php"></a>
    </div>

    <script>
        // Adicionar classe active ao item clicado
        document.querySelectorAll('.sidebar a').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.sidebar a').forEach(item => {
                    item.classList.remove('active');
                });
                this.classList.add('active');
            });
        });
        
        // Para dispositivos móveis (opcional - pode adicionar um botão de toggle)
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }
    </script>
</body>
</html>