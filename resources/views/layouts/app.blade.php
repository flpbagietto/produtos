<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Busca de Produtos' }}</title>
    @livewireStyles
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        
        .header {
            background: white;
            border-bottom: 1px solid #e0e0e0;
            padding: 16px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 16px;
        }
        
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px 20px;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 24px;
        }
        
        .sidebar {
            background: white;
            border-radius: 8px;
            padding: 20px;
            height: fit-content;
            position: sticky;
            top: 24px;
        }
        
        .sidebar h3 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .filtro-section {
            margin-bottom: 24px;
        }
        
        .filtro-section:last-child {
            margin-bottom: 0;
        }
        
        .filtro-section label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #666;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .search-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.2s;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #4285f4;
            box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.1);
        }
        
        .checkbox-list {
            max-height: 300px;
            overflow-y: auto;
        }
        
        .checkbox-item {
            display: flex;
            align-items: center;
            padding: 8px 0;
            cursor: pointer;
        }
        
        .checkbox-item:hover {
            background-color: #f9f9f9;
            margin: 0 -8px;
            padding: 8px;
            border-radius: 4px;
        }
        
        .checkbox-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            cursor: pointer;
            accent-color: #4285f4;
        }
        
        .checkbox-item label {
            flex: 1;
            cursor: pointer;
            font-size: 14px;
            font-weight: 400;
            color: #333;
            text-transform: none;
            letter-spacing: 0;
            margin: 0;
        }
        
        .btn-limpar {
            width: 100%;
            padding: 10px;
            background: #f5f5f5;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            color: #666;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 16px;
        }
        
        .btn-limpar:hover {
            background: #e8e8e8;
            border-color: #d0d0d0;
        }
        
        .content-area {
            background: white;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f3f4f6;
        }
        
        .results-count {
            font-size: 15px;
            color: #6b7280;
            font-weight: 500;
        }
        
        .results-count strong {
            color: #111827;
            font-weight: 700;
            font-size: 16px;
        }
        
        .produtos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
        }
        
        .produto-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            background: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            height: 100%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        .produto-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            border-color: #d1d5db;
            transform: translateY(-4px);
        }
        
        .produto-nome {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 12px;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            letter-spacing: -0.01em;
        }
        
        .produto-descricao {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 16px;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex-grow: 1;
        }
        
        .produto-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid #f3f4f6;
        }
        
        .tag {
            font-size: 12px;
            padding: 6px 12px;
            border-radius: 6px;
            background: #f9fafb;
            color: #4b5563;
            font-weight: 500;
            border: 1px solid #e5e7eb;
            transition: all 0.2s;
        }
        
        .tag:hover {
            background: #f3f4f6;
        }
        
        .tag-categoria {
            background: #eff6ff;
            color: #1e40af;
            border-color: #dbeafe;
        }
        
        .tag-categoria:hover {
            background: #dbeafe;
        }
        
        .tag-marca {
            background: #faf5ff;
            color: #7c3aed;
            border-color: #e9d5ff;
        }
        
        .tag-marca:hover {
            background: #e9d5ff;
        }
        
        .sem-resultados {
            text-align: center;
            padding: 60px 20px;
        }
        
        .sem-resultados-texto {
            font-size: 16px;
            color: #666;
            margin-bottom: 8px;
        }
        
        .sem-resultados-subtexto {
            font-size: 14px;
            color: #999;
        }
        
        .paginacao {
            margin-top: 32px;
            display: flex;
            justify-content: center;
        }
        
        /* Scrollbar */
        .checkbox-list::-webkit-scrollbar {
            width: 6px;
        }
        
        .checkbox-list::-webkit-scrollbar-track {
            background: #f5f5f5;
        }
        
        .checkbox-list::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 3px;
        }
        
        .checkbox-list::-webkit-scrollbar-thumb:hover {
            background: #999;
        }
        
        /* Paginação */
        .paginacao {
            margin-top: 32px;
            padding: 24px 0;
            border-top: 1px solid #f0f0f0;
        }
        
        .paginacao nav {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 4px;
            flex-wrap: wrap;
        }
        
        .paginacao nav > div {
            display: flex;
            gap: 4px;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .paginacao nav ul {
            display: flex;
            list-style: none;
            gap: 4px;
            align-items: center;
            margin: 0;
            padding: 0;
            flex-wrap: wrap;
        }
        
        .paginacao nav li {
            display: inline-block;
        }
        
        .paginacao nav a,
        .paginacao nav span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 14px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            text-decoration: none;
            color: #666;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            background: white;
            cursor: pointer;
            user-select: none;
        }
        
        .paginacao nav a:hover:not([aria-disabled="true"]):not(.disabled) {
            background: #f8f9fa;
            border-color: #4285f4;
            color: #4285f4;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(66, 133, 244, 0.1);
        }
        
        .paginacao nav span.active,
        .paginacao nav a.active,
        .paginacao nav span[aria-current="page"],
        .paginacao nav a[aria-current="page"] {
            background: #4285f4;
            color: white;
            border-color: #4285f4;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(66, 133, 244, 0.2);
        }
        
        .paginacao nav span.disabled,
        .paginacao nav a.disabled,
        .paginacao nav span[aria-disabled="true"],
        .paginacao nav a[aria-disabled="true"] {
            opacity: 0.4;
            cursor: not-allowed;
            background: #f5f5f5;
            pointer-events: none;
            border-color: #e0e0e0;
        }
        
        .paginacao nav .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .paginacao nav .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }
        
        /* Responsivo */
        @media (max-width: 768px) {
            .main-container {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                position: static;
            }
            
            .produtos-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            
            .content-area {
                padding: 20px;
            }
            
            .produto-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    {{ $slot }}
    @livewireScripts
</body>
</html>
