<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
// Calculate financial figures cleanly
$sales_amount        = (float)($total_sales->total_amount ?? 0);
$sales_tax           = (float)($total_sales->tax ?? 0);
$sales_paid          = (float)($total_sales->paid ?? 0);
$sales_count         = (int)($total_sales->total ?? 0);
$net_sales           = $sales_amount - $sales_tax;

$purchases_amount    = (float)($total_purchases->total_amount ?? 0);
$purchases_tax       = (float)($total_purchases->tax ?? 0);
$purchases_paid      = (float)($total_purchases->paid ?? 0);
$purchases_count     = (int)($total_purchases->total ?? 0);
$net_purchases       = $purchases_amount - $purchases_tax;

$returns_amount      = (float)($total_return_sales->total_amount ?? 0);
$returns_tax         = (float)($total_return_sales->tax ?? 0);
$returns_count       = (int)($total_return_sales->total ?? 0);
$net_returns         = $returns_amount - $returns_tax;

$expenses_amount     = (float)($total_expenses->total_amount ?? 0);
$expenses_count      = (int)($total_expenses->total ?? 0);

// Profit calculations
$gross_profit        = $sales_amount - $purchases_amount;
$operating_net_profit = $net_sales - $net_purchases - $net_returns;
$final_net_profit    = $operating_net_profit - $expenses_amount;

// Cash flow amounts
$rec_total           = (float)($total_received->total_amount ?? 0);
$rec_cash            = (float)($total_received_cash->total_amount ?? 0);
$rec_cc              = (float)($total_received_cc->total_amount ?? 0);
$rec_cheque          = (float)($total_received_cheque->total_amount ?? 0);
$rec_ppp             = (float)($total_received_ppp->total_amount ?? 0);
$rec_stripe          = (float)($total_received_stripe->total_amount ?? 0);

$paid_total          = (float)($total_paid->total_amount ?? 0);
$returned_total      = (float)($total_returned->total_amount ?? 0);
$returns_sales_total = (float)($total_return_sales ? $total_return_sales->total_amount : 0);

$cash_flow_net       = $rec_total - abs($returned_total) - $paid_total - $expenses_amount - $returns_sales_total;
?>
<script>
    $(document).ready(function () {
        CURI = '<?= admin_url('reports/profit_loss'); ?>';
    });
</script>
<style>
    .pl-executive-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        margin-bottom: 20px;
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    .pl-executive-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    .pl-card-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    .pl-kpi-title {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 4px;
    }
    .pl-kpi-value {
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.2;
        margin-bottom: 8px;
    }
    .pl-kpi-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 6px;
    }
    .pl-kpi-subtext {
        font-size: 12px;
        color: #64748b;
        margin-top: 6px;
    }

    /* Profit Summary Hero Cards */
    .profit-pill-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 22px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.03);
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
    }
    .profit-pill-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 5px;
    }
    .profit-pill-card.border-blue::before { background: #2563eb; }
    .profit-pill-card.border-emerald::before { background: #059669; }
    .profit-pill-card.border-purple::before { background: #7c3aed; }
    .profit-pill-card.border-rose::before { background: #e11d48; }

    .profit-label {
        font-size: 13px;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    .profit-number {
        font-size: 26px;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 8px;
    }
    .profit-formula {
        font-size: 12px;
        color: #64748b;
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 6px;
        padding: 6px 10px;
        line-height: 1.4;
    }

    /* Cash Flow Section */
    .cashflow-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }
    .cashflow-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }
    .cashflow-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 14px;
        border-radius: 8px;
        margin-bottom: 8px;
        background: #f8fafc;
        border: 1px solid #f1f5f9;
    }
    .cashflow-item:last-child {
        margin-bottom: 0;
    }

    /* Warehouse Cards */
    .warehouse-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 18px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        transition: all 0.2s ease;
    }
    .warehouse-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .wh-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 13px;
        padding: 6px 0;
        border-bottom: 1px dashed #f1f5f9;
    }
    .wh-row:last-child {
        border-bottom: none;
    }

    /* Action bar */
    .modern-action-bar {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }

    @media print {
        #header, #sidebar-left, .modern-action-bar, .box-icon, .breadcrumb {
            display: none !important;
        }
        .content-con, #content, .box {
            padding: 0 !important;
            margin: 0 !important;
            border: none !important;
        }
    }
</style>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-line-chart"></i><?= lang('profit_loss'); ?></h2>

        <div class="box-icon">
            <div class="form-group choose-date hidden-xs" style="margin-bottom:0;">
                <div class="controls">
                    <div class="input-group">
                        <span class="input-group-addon" style="background:#f8fafc; border-color:#cbd5e1; color:#2563eb;"><i class="fa fa-calendar"></i></span>
                        <input type="text"
                               value="<?= ($start ? $this->sma->hrld($start) : '') . ' - ' . ($end ? $this->sma->hrld($end) : ''); ?>"
                               id="daterange" class="form-control" style="border-color:#cbd5e1; font-weight:600; font-size:13px; cursor:pointer;" readonly>
                        <span class="input-group-addon" style="background:#f8fafc; border-color:#cbd5e1;"><i class="fa fa-chevron-down text-muted"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a href="#" id="image" class="tip" title="<?= lang('save_image') ?>">
                        <i class="icon fa fa-file-picture-o"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <!-- ================= MODERN ACTION & TOOL BAR ================= -->
                <div class="modern-action-bar">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span style="font-weight: 700; color: #1e293b; font-size: 14px; display: flex; align-items: center; gap: 8px;">
                            <i class="fa fa-sliders text-primary"></i> Período Activo:
                        </span>
                        <span style="background: #eff6ff; color: #1d4ed8; padding: 6px 14px; border-radius: 20px; font-weight: 600; font-size: 13px; border: 1px solid #bfdbfe;">
                            <i class="fa fa-clock-o" style="margin-right: 4px;"></i>
                            <?= ($start ? $this->sma->hrld($start) : 'Inicio') . ' &nbsp;➔&nbsp; ' . ($end ? $this->sma->hrld($end) : 'Hoy'); ?>
                        </span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <a href="#" id="pdf" class="btn btn-default" style="padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 13px; border: 1px solid #cbd5e1;" title="Exportar reporte en PDF">
                            <i class="fa fa-file-pdf-o text-danger"></i> Descargar PDF
                        </a>
                        <button type="button" class="btn btn-default" onclick="window.print();" style="padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 13px; border: 1px solid #cbd5e1;" title="Imprimir estado de resultados">
                            <i class="fa fa-print text-muted"></i> Imprimir
                        </button>
                    </div>
                </div>

                <!-- ================= ROW 1: 4 CORE OPERATIONAL METRICS ================= -->
                <div class="row">
                    <!-- Ventas -->
                    <div class="col-md-3 col-sm-6">
                        <div class="pl-executive-card">
                            <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 12px;">
                                <div>
                                    <div class="pl-kpi-title"><?= lang('sales') ?> Brutas</div>
                                    <div class="pl-kpi-value" style="color: #2563eb;"><?= $this->sma->formatMoney($sales_amount) ?></div>
                                </div>
                                <div class="pl-card-icon" style="background: #eff6ff; color: #2563eb;">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 4px;">
                                <span class="pl-kpi-badge" style="background: #eff6ff; color: #1d4ed8;">
                                    <i class="fa fa-check"></i> <?= $sales_count . ' ' . lang('sales') ?>
                                </span>
                                <span class="pl-kpi-badge" style="background: #f0fdf4; color: #16a34a;">
                                    Cobrado: <?= $this->sma->formatMoney($sales_paid) ?>
                                </span>
                            </div>
                            <div class="pl-kpi-subtext">
                                Neto: <strong><?= $this->sma->formatMoney($net_sales) ?></strong> | Imp: <?= $this->sma->formatMoney($sales_tax) ?>
                            </div>
                        </div>
                    </div>

                    <!-- Compras -->
                    <div class="col-md-3 col-sm-6">
                        <div class="pl-executive-card">
                            <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 12px;">
                                <div>
                                    <div class="pl-kpi-title"><?= lang('purchases') ?> Totales</div>
                                    <div class="pl-kpi-value" style="color: #d97706;"><?= $this->sma->formatMoney($purchases_amount) ?></div>
                                </div>
                                <div class="pl-card-icon" style="background: #fffbeb; color: #d97706;">
                                    <i class="fa fa-truck"></i>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 4px;">
                                <span class="pl-kpi-badge" style="background: #fffbeb; color: #b45309;">
                                    <i class="fa fa-cubes"></i> <?= $purchases_count . ' ' . lang('purchases') ?>
                                </span>
                                <span class="pl-kpi-badge" style="background: #f8fafc; color: #475569; border: 1px solid #e2e8f0;">
                                    Pagado: <?= $this->sma->formatMoney($purchases_paid) ?>
                                </span>
                            </div>
                            <div class="pl-kpi-subtext">
                                Neto: <strong><?= $this->sma->formatMoney($net_purchases) ?></strong> | Imp: <?= $this->sma->formatMoney($purchases_tax) ?>
                            </div>
                        </div>
                    </div>

                    <!-- Devoluciones -->
                    <div class="col-md-3 col-sm-6">
                        <div class="pl-executive-card">
                            <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 12px;">
                                <div>
                                    <div class="pl-kpi-title"><?= lang('returns') ?> de Venta</div>
                                    <div class="pl-kpi-value" style="color: #dc2626;"><?= $this->sma->formatMoney($returns_amount) ?></div>
                                </div>
                                <div class="pl-card-icon" style="background: #fef2f2; color: #dc2626;">
                                    <i class="fa fa-undo"></i>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 4px;">
                                <span class="pl-kpi-badge" style="background: #fef2f2; color: #b91c1c;">
                                    <i class="fa fa-refresh"></i> <?= $returns_count . ' ' . lang('returns') ?>
                                </span>
                                <span class="pl-kpi-badge" style="background: #f8fafc; color: #64748b;">
                                    Imp: <?= $this->sma->formatMoney($returns_tax) ?>
                                </span>
                            </div>
                            <div class="pl-kpi-subtext">
                                Neto Reembolsado: <strong><?= $this->sma->formatMoney($net_returns) ?></strong>
                            </div>
                        </div>
                    </div>

                    <!-- Gastos -->
                    <div class="col-md-3 col-sm-6">
                        <div class="pl-executive-card">
                            <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 12px;">
                                <div>
                                    <div class="pl-kpi-title"><?= lang('expenses') ?> Operativos</div>
                                    <div class="pl-kpi-value" style="color: #7c3aed;"><?= $this->sma->formatMoney($expenses_amount) ?></div>
                                </div>
                                <div class="pl-card-icon" style="background: #f5f3ff; color: #7c3aed;">
                                    <i class="fa fa-calculator"></i>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 4px;">
                                <span class="pl-kpi-badge" style="background: #f5f3ff; color: #6d28d9;">
                                    <i class="fa fa-tag"></i> <?= $expenses_count . ' ' . lang('expenses') ?>
                                </span>
                                <span class="pl-kpi-badge" style="background: #f8fafc; color: #64748b;">
                                    Egresos Fijos y Variables
                                </span>
                            </div>
                            <div class="pl-kpi-subtext">
                                Total Gastos Contabilizados
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= ROW 2: 3 PILLARS OF PROFITABILITY ================= -->
                <div style="margin-top: 10px; margin-bottom: 10px;">
                    <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa fa-balance-scale text-primary"></i> Estado de Resultados y Márgenes de Utilidad
                    </h3>
                </div>

                <div class="row">
                    <!-- Margen Bruto -->
                    <div class="col-md-4">
                        <div class="profit-pill-card border-blue">
                            <div class="profit-label">Margen Bruto Comercial</div>
                            <div class="profit-number" style="color: <?= $gross_profit >= 0 ? '#16a34a' : '#dc2626' ?>;">
                                <?= $this->sma->formatMoney($gross_profit) ?>
                            </div>
                            <div class="profit-formula">
                                <strong>Ventas Totales</strong> (<?= $this->sma->formatMoney($sales_amount) ?>) &minus; <strong>Compras Totales</strong> (<?= $this->sma->formatMoney($purchases_amount) ?>)
                            </div>
                        </div>
                    </div>

                    <!-- Margen Operativo Neto -->
                    <div class="col-md-4">
                        <div class="profit-pill-card border-emerald">
                            <div class="profit-label">Utilidad Neta de Venta (Sin Impuestos)</div>
                            <div class="profit-number" style="color: <?= $operating_net_profit >= 0 ? '#16a34a' : '#dc2626' ?>;">
                                <?= $this->sma->formatMoney($operating_net_profit) ?>
                            </div>
                            <div class="profit-formula">
                                (<strong>Venta Neta</strong> &minus; <strong>Compra Neta</strong>) &minus; <strong>Devolución Neta</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Utilidad Neta Real (EBITDA) -->
                    <div class="col-md-4">
                        <div class="profit-pill-card <?= $final_net_profit >= 0 ? 'border-purple' : 'border-rose' ?>" style="background: <?= $final_net_profit >= 0 ? '#faf5ff' : '#fff5f5' ?>;">
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <div class="profit-label" style="color: <?= $final_net_profit >= 0 ? '#6d28d9' : '#b91c1c' ?>;">
                                    Utilidad / Pérdida Final
                                </div>
                                <span class="pl-kpi-badge" style="background: <?= $final_net_profit >= 0 ? '#7c3aed' : '#dc2626' ?>; color: #ffffff;">
                                    <?= $final_net_profit >= 0 ? 'SUPERÁVIT' : 'DÉFICIT' ?>
                                </span>
                            </div>
                            <div class="profit-number" style="color: <?= $final_net_profit >= 0 ? '#7c3aed' : '#dc2626' ?>;">
                                <?= $this->sma->formatMoney($final_net_profit) ?>
                            </div>
                            <div class="profit-formula" style="background: rgba(255,255,255,0.7);">
                                <strong>Margen Operativo</strong> &minus; <strong>Gastos Generales</strong> (<?= $this->sma->formatMoney($expenses_amount) ?>)
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= ROW 3: CASH FLOW & PAYMENTS SUMMARY ================= -->
                <div style="margin-top: 10px; margin-bottom: 10px;">
                    <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa fa-money text-success"></i> Flujo de Tesorería y Medios de Pago
                    </h3>
                </div>

                <div class="row">
                    <!-- Cobranzas por Método -->
                    <div class="col-md-6">
                        <div class="cashflow-box">
                            <div class="cashflow-header">
                                <span style="font-weight: 700; font-size: 14px; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                                    <i class="fa fa-arrow-circle-down text-success"></i> <?= lang('payments_received') ?> (Cobranzas)
                                </span>
                                <span style="font-size: 16px; font-weight: 800; color: #16a34a;">
                                    <?= $this->sma->formatMoney($rec_total) ?>
                                </span>
                            </div>

                            <div class="cashflow-item">
                                <span style="display: flex; align-items: center; gap: 8px; color: #334155; font-size: 13px; font-weight: 600;">
                                    <i class="fa fa-money text-success" style="font-size: 16px;"></i> <?= lang('cash') ?>
                                </span>
                                <strong style="color: #0f172a; font-size: 14px;"><?= $this->sma->formatMoney($rec_cash) ?></strong>
                            </div>

                            <div class="cashflow-item">
                                <span style="display: flex; align-items: center; gap: 8px; color: #334155; font-size: 13px; font-weight: 600;">
                                    <i class="fa fa-credit-card text-primary" style="font-size: 16px;"></i> <?= lang('CC') ?> (Tarjeta)
                                </span>
                                <strong style="color: #0f172a; font-size: 14px;"><?= $this->sma->formatMoney($rec_cc) ?></strong>
                            </div>

                            <div class="cashflow-item">
                                <span style="display: flex; align-items: center; gap: 8px; color: #334155; font-size: 13px; font-weight: 600;">
                                    <i class="fa fa-check-square-o text-warning" style="font-size: 16px;"></i> <?= lang('cheque') ?>
                                </span>
                                <strong style="color: #0f172a; font-size: 14px;"><?= $this->sma->formatMoney($rec_cheque) ?></strong>
                            </div>

                            <?php if ($rec_stripe > 0 || $rec_ppp > 0) { ?>
                                <div class="cashflow-item">
                                    <span style="display: flex; align-items: center; gap: 8px; color: #334155; font-size: 13px; font-weight: 600;">
                                        <i class="fa fa-globe text-info" style="font-size: 16px;"></i> Pasarelas Online (Stripe / PayPal)
                                    </span>
                                    <strong style="color: #0f172a; font-size: 14px;"><?= $this->sma->formatMoney($rec_stripe + $rec_ppp) ?></strong>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Egresos & Balance de Caja -->
                    <div class="col-md-6">
                        <div class="cashflow-box">
                            <div class="cashflow-header">
                                <span style="font-weight: 700; font-size: 14px; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                                    <i class="fa fa-arrow-circle-up text-danger"></i> Egresos de Caja y Saldo Neto
                                </span>
                                <span style="font-size: 16px; font-weight: 800; color: <?= $cash_flow_net >= 0 ? '#16a34a' : '#dc2626' ?>;">
                                    Neto: <?= $this->sma->formatMoney($cash_flow_net) ?>
                                </span>
                            </div>

                            <div class="cashflow-item">
                                <span style="display: flex; align-items: center; gap: 8px; color: #334155; font-size: 13px; font-weight: 600;">
                                    <i class="fa fa-shopping-bag text-warning" style="font-size: 16px;"></i> <?= lang('payments_sent') ?> (Proveedores)
                                </span>
                                <strong style="color: #dc2626; font-size: 14px;">- <?= $this->sma->formatMoney($paid_total) ?></strong>
                            </div>

                            <div class="cashflow-item">
                                <span style="display: flex; align-items: center; gap: 8px; color: #334155; font-size: 13px; font-weight: 600;">
                                    <i class="fa fa-calculator text-purple" style="font-size: 16px; color: #7c3aed;"></i> <?= lang('expenses') ?> Operativos
                                </span>
                                <strong style="color: #dc2626; font-size: 14px;">- <?= $this->sma->formatMoney($expenses_amount) ?></strong>
                            </div>

                            <div class="cashflow-item">
                                <span style="display: flex; align-items: center; gap: 8px; color: #334155; font-size: 13px; font-weight: 600;">
                                    <i class="fa fa-reply text-danger" style="font-size: 16px;"></i> Reembolsos & Devoluciones
                                </span>
                                <strong style="color: #dc2626; font-size: 14px;">- <?= $this->sma->formatMoney(abs($returned_total) + $returns_sales_total) ?></strong>
                            </div>

                            <div class="cashflow-item" style="background: <?= $cash_flow_net >= 0 ? '#f0fdf4' : '#fef2f2' ?>; border-color: <?= $cash_flow_net >= 0 ? '#bbf7d0' : '#fecaca' ?>;">
                                <span style="display: flex; align-items: center; gap: 8px; color: <?= $cash_flow_net >= 0 ? '#166534' : '#991b1b' ?>; font-size: 13px; font-weight: 700;">
                                    <i class="fa fa-shield" style="font-size: 16px;"></i> Balance Neto en Tesorería
                                </span>
                                <strong style="color: <?= $cash_flow_net >= 0 ? '#15803d' : '#b91c1c' ?>; font-size: 15px;">
                                    <?= $this->sma->formatMoney($cash_flow_net) ?>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= ROW 4: WAREHOUSES PERFORMANCE BREAKDOWN ================= -->
                <?php if (!empty($warehouses_report)) { ?>
                    <div style="margin-top: 10px; margin-bottom: 10px;">
                        <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                            <i class="fa fa-building-o text-primary"></i> Rendimiento y Utilidad por Almacén / Sucursal
                        </h3>
                    </div>

                    <div class="row">
                        <?php foreach ($warehouses_report as $wh_rep) {
                            $w_sales_tot     = (float)($wh_rep['total_sales']->total_amount ?? 0);
                            $w_sales_tax     = (float)($wh_rep['total_sales']->tax ?? 0);
                            $w_sales_net     = $w_sales_tot - $w_sales_tax;

                            $w_pur_tot       = (float)($wh_rep['total_purchases']->total_amount ?? 0);
                            $w_pur_tax       = (float)($wh_rep['total_purchases']->tax ?? 0);
                            $w_pur_net       = $w_pur_tot - $w_pur_tax;

                            $w_ret_tot       = (float)($wh_rep['total_returns']->total_amount ?? 0);
                            $w_ret_tax       = (float)($wh_rep['total_returns']->tax ?? 0);
                            $w_ret_net       = $w_ret_tot - $w_ret_tax;

                            $w_exp_tot       = (float)($wh_rep['total_expenses']->total_amount ?? 0);

                            // Warehouse net profit
                            $w_net_profit    = $w_sales_net - $w_pur_net - $w_ret_net - $w_exp_tot;
                        ?>
                            <div class="col-md-4 col-sm-6">
                                <div class="warehouse-card">
                                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; padding-bottom: 10px; border-bottom: 1px solid #f1f5f9;">
                                        <div style="font-weight: 700; font-size: 14px; color: #0f172a;">
                                            <i class="fa fa-cubes text-primary" style="margin-right: 6px;"></i>
                                            <?= htmlspecialchars($wh_rep['warehouse']->name); ?>
                                        </div>
                                        <span class="pl-kpi-badge" style="background: #f1f5f9; color: #475569; font-weight: 700;">
                                            <?= htmlspecialchars($wh_rep['warehouse']->code); ?>
                                        </span>
                                    </div>

                                    <div class="wh-row">
                                        <span class="text-muted"><i class="fa fa-arrow-down text-success"></i> Venta Neta</span>
                                        <strong style="color: #16a34a;"><?= $this->sma->formatMoney($w_sales_net) ?></strong>
                                    </div>

                                    <div class="wh-row">
                                        <span class="text-muted"><i class="fa fa-arrow-up text-warning"></i> Compra Neta</span>
                                        <strong style="color: #d97706;"><?= $this->sma->formatMoney($w_pur_net) ?></strong>
                                    </div>

                                    <div class="wh-row">
                                        <span class="text-muted"><i class="fa fa-reply text-danger"></i> Devolución Neta</span>
                                        <strong style="color: #dc2626;"><?= $this->sma->formatMoney($w_ret_net) ?></strong>
                                    </div>

                                    <div class="wh-row">
                                        <span class="text-muted"><i class="fa fa-calculator text-purple" style="color:#7c3aed;"></i> Gastos Almacén</span>
                                        <strong style="color: #7c3aed;"><?= $this->sma->formatMoney($w_exp_tot) ?></strong>
                                    </div>

                                    <div style="margin-top: 14px; padding: 12px; border-radius: 8px; background: <?= $w_net_profit >= 0 ? '#f0fdf4' : '#fef2f2' ?>; border: 1px solid <?= $w_net_profit >= 0 ? '#bbf7d0' : '#fecaca' ?>; display: flex; align-items: center; justify-content: space-between;">
                                        <span style="font-size: 12px; font-weight: 700; color: <?= $w_net_profit >= 0 ? '#166534' : '#991b1b' ?>;">
                                            <?= $w_net_profit >= 0 ? 'Resultado Almacén' : 'Déficit Almacén' ?>
                                        </span>
                                        <span style="font-size: 15px; font-weight: 800; color: <?= $w_net_profit >= 0 ? '#15803d' : '#b91c1c' ?>;">
                                            <?= $this->sma->formatMoney($w_net_profit) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= $assets ?>js/html2canvas.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#pdf').click(function (event) {
            event.preventDefault();
            window.location.href = "<?=admin_url('reports/profit_loss_pdf')?>/" + encodeURIComponent('<?=$start?>') + "/" + encodeURIComponent('<?=$end?>');
            return false;
        });
        $('#image').click(function (event) {
            event.preventDefault();
            html2canvas($('.box'), {
                onrendered: function (canvas) {
                    openImg(canvas.toDataURL());
                }
            });
            return false;
        });
    });
</script>
