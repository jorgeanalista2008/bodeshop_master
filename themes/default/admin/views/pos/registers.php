<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php
// Calculate metrics
$open_count = !empty($registers) ? count($registers) : 0;
$total_cash_in_hand = 0;
if (!empty($registers)) {
    foreach ($registers as $r) {
        $total_cash_in_hand += (float)$r->cash_in_hand;
    }
}

// Fetch last 5 closed registers for historical reference
$closed_registers = $this->db->select("pos_register.*, CONCAT({$this->db->dbprefix('users')}.first_name, ' ', {$this->db->dbprefix('users')}.last_name) as user_name, {$this->db->dbprefix('users')}.email")
    ->join('users', 'users.id=pos_register.user_id', 'left')
    ->where('pos_register.status', 'close')
    ->order_by('pos_register.id', 'DESC')
    ->limit(5)
    ->get('pos_register')
    ->result();

$last_closed = !empty($closed_registers) ? $closed_registers[0] : null;
?>

<style>
    .pos-kpi-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 16px 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        transition: all 0.2s;
    }
    .pos-kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .pos-kpi-info h4 {
        margin: 0 0 4px 0;
        font-size: 22px;
        font-weight: 700;
        color: #0f172a;
    }
    .pos-kpi-info span {
        font-size: 12px;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .pos-kpi-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    .kpi-icon-green { background: #f0fdf4; color: #16a34a; }
    .kpi-icon-blue { background: #eff6ff; color: #2563eb; }
    .kpi-icon-slate { background: #f1f5f9; color: #475569; }

    .open-pulse {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #22c55e;
        margin-right: 6px;
        box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
        animation: pulse-green 1.8s infinite;
    }
    @keyframes pulse-green {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(34, 197, 94, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
    }

    .registers-empty-state {
        background: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        padding: 45px 20px;
        text-align: center;
        margin: 15px 0 25px 0;
    }
    .registers-empty-state .empty-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background-color: #f1f5f9;
        color: #64748b;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-bottom: 14px;
    }
    .registers-empty-state h4 {
        margin: 0 0 6px 0;
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
    }
    .registers-empty-state p {
        margin: 0 auto 16px auto;
        max-width: 500px;
        font-size: 13px;
        color: #64748b;
    }

    .registers-header-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .registers-title-wrap h3 {
        margin: 0 0 4px 0;
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .registers-title-wrap p {
        margin: 0;
        font-size: 13px;
        color: #64748b;
    }
    .user-avatar-badge {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #eff6ff;
        color: #1d4ed8;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        font-size: 13px;
    }
    .active-register-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 15px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .active-register-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 10px rgba(0,0,0,0.06);
    }
</style>

<!-- Top KPI Metric Cards -->
<div class="row" style="margin-top: 10px;">
    <div class="col-sm-6 col-md-4">
        <div class="pos-kpi-card">
            <div class="pos-kpi-info">
                <h4>
                    <?php if ($open_count > 0): ?>
                        <span class="open-pulse"></span>
                    <?php endif; ?>
                    <?= $open_count ?>
                </h4>
                <span><?= lang('open_registers'); ?></span>
            </div>
            <div class="pos-kpi-icon <?= $open_count > 0 ? 'kpi-icon-green' : 'kpi-icon-slate' ?>">
                <i class="fa fa-briefcase"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="pos-kpi-card">
            <div class="pos-kpi-info">
                <h4><?= $this->sma->formatMoney($total_cash_in_hand) ?></h4>
                <span>Efectivo Total en Apertura</span>
            </div>
            <div class="pos-kpi-icon kpi-icon-blue">
                <i class="fa fa-money"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="pos-kpi-card">
            <div class="pos-kpi-info">
                <h4 style="font-size: 16px; color: #334155;">
                    <?= $last_closed ? date('d/m/Y H:i', strtotime($last_closed->closed_at)) : 'Ninguno hoy' ?>
                </h4>
                <span>Último Cierre Registrado</span>
            </div>
            <div class="pos-kpi-icon kpi-icon-slate">
                <i class="fa fa-clock-o"></i>
            </div>
        </div>
    </div>
</div>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-briefcase"></i><?= lang('open_registers'); ?></h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li>
                    <a href="<?= admin_url('pos'); ?>" class="tip" title="<?= lang('pos'); ?>">
                        <i class="icon fa fa-shopping-cart"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="registers-header-bar">
                    <div class="registers-title-wrap">
                        <h3><i class="fa fa-desktop text-primary"></i> Sesiones y Cajas Registradoras</h3>
                        <p><?= lang('review_opened_registers'); ?> &bull; Monitoreo de arqueo y estado de terminales de venta.</p>
                    </div>
                    <div>
                        <a href="<?= admin_url('pos'); ?>" class="btn btn-success" style="border-radius: 6px; font-weight: 600; padding: 7px 16px;">
                            <i class="fa fa-shopping-cart"></i> Abrir Punto de Venta (POS)
                        </a>
                    </div>
                </div>

                <!-- Cajas Abiertas Actuales -->
                <?php if (!empty($registers)): ?>
                    <div style="margin-bottom: 24px;">
                        <h4 style="font-size: 14px; font-weight: 700; color: #1e3a8a; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px;">
                            <i class="fa fa-check-circle text-success"></i> Cajas Abiertas Actualmente (<?= count($registers) ?>)
                        </h4>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" style="border-radius: 8px; overflow: hidden;">
                                <thead>
                                    <tr style="background-color: #f8fafc; color: #334155; font-size: 12px; font-weight: 600;">
                                        <th><?= lang('user'); ?></th>
                                        <th><?= lang('opened_at'); ?></th>
                                        <th><?= lang('cash_in_hand'); ?> (Monto Inicial)</th>
                                        <th style="text-align: center;">Estado</th>
                                        <th style="width: 140px; text-align: center;"><?= lang('actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($registers as $register): 
                                        $initials = strtoupper(substr(trim($register->user), 0, 2));
                                    ?>
                                        <tr>
                                            <td style="vertical-align: middle;">
                                                <div style="display: flex; align-items: center;">
                                                    <span class="user-avatar-badge"><?= $initials ?></span>
                                                    <div>
                                                        <strong style="color: #0f172a;"><?= htmlspecialchars($register->user); ?></strong>
                                                        <div style="font-size: 11px; color: #64748b;">Cajero / Operador POS</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle; color: #334155;">
                                                <i class="fa fa-calendar text-muted"></i> <?= $this->sma->hrld($register->date); ?>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <span style="font-size: 14px; font-weight: 700; color: #15803d; background: #f0fdf4; border: 1px solid #bbf7d0; padding: 4px 10px; border-radius: 6px;">
                                                    <?= $this->sma->formatMoney($register->cash_in_hand); ?>
                                                </span>
                                            </td>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <span class="badge" style="background-color: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; padding: 5px 12px; font-weight: 600; border-radius: 20px;">
                                                    <span class="open-pulse"></span> Abierta / Activa
                                                </span>
                                            </td>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="<?= admin_url('pos/close_register/' . $register->user_id); ?>" data-target="#myModal" data-toggle="modal" class="btn btn-danger btn-sm" style="border-radius: 6px; font-weight: 600;" title="Realizar arqueo y cerrar turno">
                                                    <i class="fa fa-times-circle"></i> <?= lang('close_register'); ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Empty State -->
                    <div class="registers-empty-state">
                        <div class="empty-icon">
                            <i class="fa fa-briefcase"></i>
                        </div>
                        <h4>Todas las cajas registradoras están cerradas</h4>
                        <p>No hay turnos activos de venta en este momento. Puede iniciar una nueva sesión de caja ingresando al punto de venta con el fondo inicial en efectivo.</p>
                        <a href="<?= admin_url('pos'); ?>" class="btn btn-primary" style="border-radius: 6px; padding: 9px 22px; font-weight: 600;">
                            <i class="fa fa-shopping-cart"></i> Iniciar Turno en POS
                        </a>
                    </div>
                <?php endif; ?>

                <!-- Historial de Cierres Recientes -->
                <?php if (!empty($closed_registers)): ?>
                    <div style="margin-top: 20px;">
                        <h4 style="font-size: 13px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px;">
                            <i class="fa fa-history text-muted"></i> Historial de Cierres Recientes (Últimos Turnos)
                        </h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" style="font-size: 12px; border-radius: 8px; overflow: hidden;">
                                <thead>
                                    <tr style="background-color: #f1f5f9; color: #475569;">
                                        <th>Cajero</th>
                                        <th>Apertura</th>
                                        <th>Cierre</th>
                                        <th>Fondo Inicial</th>
                                        <th>Total Efectivo Registrado</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($closed_registers as $cr): ?>
                                        <tr>
                                            <td><strong><?= htmlspecialchars($cr->user_name ? $cr->user_name : $cr->email); ?></strong></td>
                                            <td class="text-muted"><?= $this->sma->hrld($cr->date); ?></td>
                                            <td><?= $cr->closed_at ? $this->sma->hrld($cr->closed_at) : '-' ?></td>
                                            <td><?= $this->sma->formatMoney($cr->cash_in_hand); ?></td>
                                            <td><strong style="color: #0f172a;"><?= $this->sma->formatMoney($cr->total_cash); ?></strong></td>
                                            <td>
                                                <span class="label label-default" style="border-radius: 12px; padding: 3px 8px;">Cerrada</span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
