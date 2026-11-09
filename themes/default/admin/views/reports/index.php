<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
// Initialize chart data safely for PHP 8.2
$months    = [];
$sales     = [];
$tax1      = [];
$tax2      = [];
$purchases = [];
$tax3      = [];
if (!empty($monthly_sales)) {
    foreach ($monthly_sales as $month_sale) {
        $months[]    = date('M-Y', strtotime($month_sale->month));
        $sales[]     = (float)$month_sale->sales;
        $tax1[]      = (float)$month_sale->tax1;
        $tax2[]      = (float)$month_sale->tax2;
        $purchases[] = (float)$month_sale->purchases;
        $tax3[]      = (float)$month_sale->ptax;
    }
}

// Compute situational awareness KPIs
$cur_m_sales = $this->db->query("SELECT COALESCE(SUM(grand_total), 0) as total, COUNT(*) as count FROM " . $this->db->dbprefix('sales') . " WHERE MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())")->row();
$cur_m_purchases = $this->db->query("SELECT COALESCE(SUM(grand_total), 0) as total, COUNT(*) as count FROM " . $this->db->dbprefix('purchases') . " WHERE MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())")->row();
$alerts = $this->db->query("SELECT (SELECT COUNT(*) FROM " . $this->db->dbprefix('products') . " WHERE alert_quantity > 0 AND quantity <= alert_quantity) as qty_alerts")->row();
?>

<style type="text/css" media="screen">
    /* Modern UI/UX Styles for Reports Dashboard */
    .rep-container {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    /* KPI Summary Cards */
    .rep-kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }
    .rep-kpi-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 18px 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .rep-kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.08);
    }
    .rep-kpi-info h4 {
        margin: 0 0 4px 0;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        font-weight: 700;
        color: #64748b;
    }
    .rep-kpi-info .rep-kpi-val {
        font-size: 22px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.2;
    }
    .rep-kpi-info .rep-kpi-sub {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 4px;
        display: block;
    }
    .rep-kpi-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    .rep-kpi-icon.blue { background: #eff6ff; color: #2563eb; }
    .rep-kpi-icon.emerald { background: #ecfdf5; color: #059669; }
    .rep-kpi-icon.indigo { background: #e0e7ff; color: #4338ca; }
    .rep-kpi-icon.amber { background: #fffbeb; color: #d97706; }

    /* Categorized Report Sections */
    .rep-section {
        margin-bottom: 24px;
    }
    .rep-section-header {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 14px;
        padding-bottom: 8px;
        border-bottom: 1px solid #e2e8f0;
    }
    .rep-section-header i {
        color: #3b82f4;
    }
    
    .rep-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 16px;
    }
    .rep-item-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 16px 18px;
        display: flex;
        align-items: center;
        gap: 14px;
        text-decoration: none !important;
        transition: all 0.2s ease;
        box-shadow: 0 1px 2px rgba(0,0,0,0.03);
    }
    .rep-item-card:hover {
        transform: translateY(-2px);
        border-color: #3b82f4;
        box-shadow: 0 6px 12px -2px rgba(59, 130, 246, 0.12);
    }
    .rep-item-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }
    .rep-item-body {
        flex-grow: 1;
        overflow: hidden;
    }
    .rep-item-title {
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 2px 0;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }
    .rep-item-desc {
        font-size: 12px;
        color: #64748b;
        margin: 0;
        line-height: 1.3;
    }
    .rep-item-arrow {
        color: #cbd5e1;
        font-size: 14px;
        transition: transform 0.2s, color 0.2s;
    }
    .rep-item-card:hover .rep-item-arrow {
        color: #2563eb;
        transform: translateX(3px);
    }

    /* Icon Palette */
    .icon-blue { background: #eff6ff; color: #2563eb; }
    .icon-green { background: #ecfdf5; color: #059669; }
    .icon-purple { background: #faf5ff; color: #7c3aed; }
    .icon-amber { background: #fffbeb; color: #d97706; }
    .icon-rose { background: #fff1f2; color: #e11d48; }
    .icon-cyan { background: #ecfeff; color: #0891b2; }

    /* Modern Box for Highcharts */
    .rep-chart-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        margin-top: 24px;
    }
    .rep-chart-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid #edf2f7;
    }
    .rep-chart-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 8px;
    }
</style>

<div class="rep-container">

    <!-- KPI Summary Row -->
    <div class="rep-kpi-grid">
        <div class="rep-kpi-card">
            <div class="rep-kpi-info">
                <h4>Valor Total Inventario</h4>
                <div class="rep-kpi-val" style="color: #2563eb;">
                    <?= $this->sma->formatMoney($stock ? $stock->stock_by_cost : 0); ?>
                </div>
                <span class="rep-kpi-sub">Venta est.: <?= $this->sma->formatMoney($stock ? $stock->stock_by_price : 0); ?></span>
            </div>
            <div class="rep-kpi-icon blue">
                <i class="fa fa-cubes"></i>
            </div>
        </div>

        <div class="rep-kpi-card">
            <div class="rep-kpi-info">
                <h4>Ventas del Mes</h4>
                <div class="rep-kpi-val" style="color: #059669;">
                    <?= $this->sma->formatMoney($cur_m_sales ? $cur_m_sales->total : 0); ?>
                </div>
                <span class="rep-kpi-sub"><?= (int)($cur_m_sales ? $cur_m_sales->count : 0); ?> transacciones este mes</span>
            </div>
            <div class="rep-kpi-icon emerald">
                <i class="fa fa-line-chart"></i>
            </div>
        </div>

        <div class="rep-kpi-card">
            <div class="rep-kpi-info">
                <h4>Compras del Mes</h4>
                <div class="rep-kpi-val" style="color: #4338ca;">
                    <?= $this->sma->formatMoney($cur_m_purchases ? $cur_m_purchases->total : 0); ?>
                </div>
                <span class="rep-kpi-sub"><?= (int)($cur_m_purchases ? $cur_m_purchases->count : 0); ?> recepciones este mes</span>
            </div>
            <div class="rep-kpi-icon indigo">
                <i class="fa fa-truck"></i>
            </div>
        </div>

        <div class="rep-kpi-card">
            <div class="rep-kpi-info">
                <h4>Alertas de Stock</h4>
                <div class="rep-kpi-val" style="color: <?= ((int)($alerts ? $alerts->qty_alerts : 0) > 0) ? '#d97706' : '#059669'; ?>;">
                    <?= (int)($alerts ? $alerts->qty_alerts : 0); ?>
                </div>
                <span class="rep-kpi-sub">Productos en nivel crítico</span>
            </div>
            <div class="rep-kpi-icon amber">
                <i class="fa fa-bell-o"></i>
            </div>
        </div>
    </div>

    <!-- Categorized Reports Grid -->
    
    <!-- Categoría 1: Inventario & Almacenes -->
    <div class="rep-section">
        <div class="rep-section-header">
            <i class="fa fa-cubes"></i> Inventario, Existencias y Productos
        </div>
        <div class="rep-cards-grid">
            <a href="<?= admin_url('reports/warehouse_stock') ?>" class="rep-item-card">
                <div class="rep-item-icon icon-blue"><i class="fa fa-building"></i></div>
                <div class="rep-item-body">
                    <h5 class="rep-item-title"><?= lang('warehouse_stock') ?></h5>
                    <p class="rep-item-desc">Valor y unidades agrupadas por almacén</p>
                </div>
                <i class="fa fa-chevron-right rep-item-arrow"></i>
            </a>

            <a href="<?= admin_url('reports/products') ?>" class="rep-item-card">
                <div class="rep-item-icon icon-cyan"><i class="fa fa-barcode"></i></div>
                <div class="rep-item-body">
                    <h5 class="rep-item-title"><?= lang('products_report') ?></h5>
                    <p class="rep-item-desc">Movimientos y rentabilidad por ítem</p>
                </div>
                <i class="fa fa-chevron-right rep-item-arrow"></i>
            </a>

            <a href="<?= admin_url('reports/best_sellers') ?>" class="rep-item-card">
                <div class="rep-item-icon icon-green"><i class="fa fa-star"></i></div>
                <div class="rep-item-body">
                    <h5 class="rep-item-title"><?= lang('best_sellers') ?></h5>
                    <p class="rep-item-desc">Productos con mayor volumen de salida</p>
                </div>
                <i class="fa fa-chevron-right rep-item-arrow"></i>
            </a>

            <a href="<?= admin_url('reports/quantity_alerts') ?>" class="rep-item-card">
                <div class="rep-item-icon icon-amber"><i class="fa fa-exclamation-triangle"></i></div>
                <div class="rep-item-body">
                    <h5 class="rep-item-title"><?= lang('product_quantity_alerts') ?></h5>
                    <p class="rep-item-desc">Ítems que alcanzaron el stock de alerta</p>
                </div>
                <i class="fa fa-chevron-right rep-item-arrow"></i>
            </a>

            <a href="<?= admin_url('reports/expiry_alerts') ?>" class="rep-item-card">
                <div class="rep-item-icon icon-rose"><i class="fa fa-clock-o"></i></div>
                <div class="rep-item-body">
                    <h5 class="rep-item-title"><?= lang('product_expiry_alerts') ?></h5>
                    <p class="rep-item-desc">Vencimientos y caducidades programadas</p>
                </div>
                <i class="fa fa-chevron-right rep-item-arrow"></i>
            </a>
        </div>
    </div>

    <!-- Categoría 2: Ventas y Cobranzas -->
    <div class="rep-section">
        <div class="rep-section-header">
            <i class="fa fa-shopping-cart"></i> Ventas, Facturación y Recaudación
        </div>
        <div class="rep-cards-grid">
            <a href="<?= admin_url('reports/daily_sales') ?>" class="rep-item-card">
                <div class="rep-item-icon icon-green"><i class="fa fa-calendar"></i></div>
                <div class="rep-item-body">
                    <h5 class="rep-item-title"><?= lang('daily_sales') ?></h5>
                    <p class="rep-item-desc">Calendario y corte por día del mes</p>
                </div>
                <i class="fa fa-chevron-right rep-item-arrow"></i>
            </a>

            <a href="<?= admin_url('reports/monthly_sales') ?>" class="rep-item-card">
                <div class="rep-item-icon icon-blue"><i class="fa fa-calendar-check-o"></i></div>
                <div class="rep-item-body">
                    <h5 class="rep-item-title"><?= lang('monthly_sales') ?></h5>
                    <p class="rep-item-desc">Histórico y comparativa mensual</p>
                </div>
                <i class="fa fa-chevron-right rep-item-arrow"></i>
            </a>

            <a href="<?= admin_url('reports/sales') ?>" class="rep-item-card">
                <div class="rep-item-icon icon-purple"><i class="fa fa-file-text-o"></i></div>
                <div class="rep-item-body">
                    <h5 class="rep-item-title"><?= lang('sales_report') ?></h5>
                    <p class="rep-item-desc">Detalle completo de ventas y filtros avanzados</p>
                </div>
                <i class="fa fa-chevron-right rep-item-arrow"></i>
            </a>

            <a href="<?= admin_url('reports/payments') ?>" class="rep-item-card">
                <div class="rep-item-icon icon-amber"><i class="fa fa-money"></i></div>
                <div class="rep-item-body">
                    <h5 class="rep-item-title"><?= lang('payments_report') ?></h5>
                    <p class="rep-item-desc">Ingresos registrados por método de pago</p>
                </div>
                <i class="fa fa-chevron-right rep-item-arrow"></i>
            </a>
        </div>
    </div>

    <!-- Categoría 3: Finanzas, P&L y Compras -->
    <div class="rep-section">
        <div class="rep-section-header">
            <i class="fa fa-line-chart"></i> Rentabilidad, P&L y Proveedores
        </div>
        <div class="rep-cards-grid">
            <a href="<?= admin_url('reports/profit_loss') ?>" class="rep-item-card">
                <div class="rep-item-icon icon-green"><i class="fa fa-balance-scale"></i></div>
                <div class="rep-item-body">
                    <h5 class="rep-item-title"><?= lang('profit_and_loss') ?></h5>
                    <p class="rep-item-desc">Estado integral de pérdidas y ganancias netas</p>
                </div>
                <i class="fa fa-chevron-right rep-item-arrow"></i>
            </a>

            <a href="<?= admin_url('reports/purchases') ?>" class="rep-item-card">
                <div class="rep-item-icon icon-indigo"><i class="fa fa-shopping-basket"></i></div>
                <div class="rep-item-body">
                    <h5 class="rep-item-title"><?= lang('purchases_report') ?></h5>
                    <p class="rep-item-desc">Recepción de compras y órdenes emitidas</p>
                </div>
                <i class="fa fa-chevron-right rep-item-arrow"></i>
            </a>

            <a href="<?= admin_url('reports/suppliers') ?>" class="rep-item-card">
                <div class="rep-item-icon icon-purple"><i class="fa fa-truck"></i></div>
                <div class="rep-item-body">
                    <h5 class="rep-item-title"><?= lang('suppliers_report') ?></h5>
                    <p class="rep-item-desc">Histórico de compras y pagos por proveedor</p>
                </div>
                <i class="fa fa-chevron-right rep-item-arrow"></i>
            </a>
        </div>
    </div>

    <!-- Categoría 4: Clientes y Personal -->
    <div class="rep-section">
        <div class="rep-section-header">
            <i class="fa fa-users"></i> Clientes y Desempeño de Personal
        </div>
        <div class="rep-cards-grid">
            <a href="<?= admin_url('reports/customers') ?>" class="rep-item-card">
                <div class="rep-item-icon icon-blue"><i class="fa fa-user"></i></div>
                <div class="rep-item-body">
                    <h5 class="rep-item-title"><?= lang('customers_report') ?></h5>
                    <p class="rep-item-desc">Ventas, facturas y saldos por cliente</p>
                </div>
                <i class="fa fa-chevron-right rep-item-arrow"></i>
            </a>

            <a href="<?= admin_url('reports/staff_report') ?>" class="rep-item-card">
                <div class="rep-item-icon icon-cyan"><i class="fa fa-id-badge"></i></div>
                <div class="rep-item-body">
                    <h5 class="rep-item-title"><?= lang('staff_report') ?></h5>
                    <p class="rep-item-desc">Rendimiento, ventas y cobros por usuario</p>
                </div>
                <i class="fa fa-chevron-right rep-item-arrow"></i>
            </a>
        </div>
    </div>

    <!-- Gráfico Comparativo Highcharts -->
    <?php if ($Owner || $Admin) { ?>
        <div class="rep-chart-box">
            <div class="rep-chart-header">
                <h3><i class="fa fa-bar-chart text-primary"></i> <?= lang('overview_chart'); ?></h3>
                <span style="font-size: 12px; color: #64748b;"><?= lang('chart_lable_toggle'); ?></span>
            </div>
            <div id="chart" style="width:100%; height:450px;"></div>
        </div>

        <script src="<?= $assets; ?>js/hc/highcharts.js"></script>
        <script type="text/javascript">
            $(function () {
                Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
                    return {
                        radialGradient: {cx: 0.5, cy: 0.3, r: 0.7},
                        stops: [[0, color], [1, Highcharts.Color(color).brighten(-0.3).get('rgb')]]
                    };
                });
                $('#chart').highcharts({
                    chart: {},
                    credits: {enabled: false},
                    title: {text: ''},
                    xAxis: {categories: <?= json_encode($months); ?>},
                    yAxis: {min: 0, title: ""},
                    tooltip: {
                        shared: true,
                        followPointer: true,
                        formatter: function () {
                            if (this.key) {
                                return '<div class="tooltip-inner hc-tip" style="margin-bottom:0;">' + this.key + '<br><strong>' + currencyFormat(this.y) + '</strong> (' + formatNumber(this.percentage) + '%)';
                            } else {
                                var s = '<div class="well well-sm hc-tip" style="margin-bottom:0; background:#fff; border:1px solid #cbd5e1; box-shadow:0 4px 6px -1px rgba(0,0,0,0.1);"><h3 style="margin-top:0; font-size:14px; font-weight:700;">' + this.x + '</h3><table class="table table-striped" style="margin-bottom:0;">';
                                $.each(this.points, function () {
                                    s += '<tr><td style="color:' + this.series.color + ';padding:2px 8px 2px 0;">' + this.series.name + ': </td><td style="color:' + this.series.color + ';padding:2px 0 2px 8px;text-align:right;"> <b>' +
                                    currencyFormat(this.y) + '</b></td></tr>';
                                });
                                s += '</table></div>';
                                return s;
                            }
                        },
                        useHTML: true,
                        borderWidth: 0,
                        shadow: false,
                        valueDecimals: site.settings.decimals,
                        style: {
                            fontSize: '13px',
                            padding: '0',
                            color: '#000000'
                        }
                    },
                    series: [{
                        type: 'column',
                        name: '<?= lang('sp_tax'); ?>',
                        data: [<?= implode(', ', $tax1); ?>]
                    }, {
                        type: 'column',
                        name: '<?= lang('order_tax'); ?>',
                        data: [<?= implode(', ', $tax2); ?>]
                    }, {
                        type: 'column',
                        name: '<?= lang('sales'); ?>',
                        data: [<?= implode(', ', $sales); ?>]
                    }, {
                        type: 'spline',
                        name: '<?= lang('purchases'); ?>',
                        data: [<?= implode(', ', $purchases); ?>],
                        marker: {
                            lineWidth: 2,
                            states: { hover: { lineWidth: 4 } },
                            lineColor: Highcharts.getOptions().colors[3],
                            fillColor: 'white'
                        }
                    }, {
                        type: 'spline',
                        name: '<?= lang('pp_tax'); ?>',
                        data: [<?= implode(', ', $tax3); ?>],
                        marker: {
                            lineWidth: 2,
                            states: { hover: { lineWidth: 4 } },
                            lineColor: Highcharts.getOptions().colors[3],
                            fillColor: 'white'
                        }
                    }, {
                        type: 'pie',
                        name: '<?= lang('stock_value'); ?>',
                        data: [
                            ['', 0],
                            ['', 0],
                            ['<?= lang('stock_value_by_price'); ?>', <?= $stock ? (float)$stock->stock_by_price : 0; ?>],
                            ['<?= lang('stock_value_by_cost'); ?>', <?= $stock ? (float)$stock->stock_by_cost : 0; ?>],
                        ],
                        center: [80, 42],
                        size: 80,
                        showInLegend: false,
                        dataLabels: { enabled: false }
                    }]
                });
            });
        </script>
    <?php } ?>
</div>
