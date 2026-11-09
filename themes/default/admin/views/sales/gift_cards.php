<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
// Calculate gift card metrics from database
$q_stats = $this->db->query("SELECT 
    COUNT(*) as total_cards,
    COALESCE(SUM(value), 0) as total_initial_value,
    COALESCE(SUM(balance), 0) as total_available_balance,
    SUM(CASE WHEN balance > 0 THEN 1 ELSE 0 END) as active_cards,
    SUM(CASE WHEN balance <= 0 THEN 1 ELSE 0 END) as empty_cards
FROM {$this->db->dbprefix('gift_cards')}");
$gc_stats = $q_stats ? $q_stats->row() : null;
$total_cards = $gc_stats ? (int)$gc_stats->total_cards : 0;
$total_initial_val = $gc_stats ? (float)$gc_stats->total_initial_value : 0.0;
$total_avail_bal = $gc_stats ? (float)$gc_stats->total_available_balance : 0.0;
$active_cards = $gc_stats ? (int)$gc_stats->active_cards : 0;
$empty_cards = $gc_stats ? (int)$gc_stats->empty_cards : 0;
?>

<style>
    .gc-kpi-card {
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
    .gc-kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .gc-kpi-info h4 {
        margin: 0 0 4px 0;
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
    }
    .gc-kpi-info span {
        font-size: 12px;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .gc-kpi-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    .kpi-icon-purple { background: #f5f3ff; color: #7c3aed; }
    .kpi-icon-green { background: #f0fdf4; color: #16a34a; }
    .kpi-icon-blue { background: #eff6ff; color: #2563eb; }
    .kpi-icon-slate { background: #f1f5f9; color: #475569; }

    .gc-card-chip {
        display: inline-flex;
        align-items: center;
        background: #f8fafc;
        border: 1px solid #cbd5e1;
        padding: 3px 8px;
        border-radius: 6px;
        font-family: Consolas, Monaco, monospace;
        font-size: 13px;
        color: #1e3a8a;
        letter-spacing: 0.5px;
    }
    .gift-cards-header-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .gift-cards-title-wrap h3 {
        margin: 0 0 4px 0;
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .gift-cards-title-wrap p {
        margin: 0;
        font-size: 13px;
        color: #64748b;
    }
    #GCData {
        border-radius: 8px;
        overflow: hidden;
    }
    #GCData thead th {
        background-color: #f8fafc !important;
        color: #334155 !important;
        font-weight: 600 !important;
        border-bottom: 2px solid #e2e8f0 !important;
        font-size: 12px !important;
    }
    #GCData tbody tr {
        transition: background-color 0.15s ease;
    }
    #GCData tbody tr:hover {
        background-color: #f1f5f9 !important;
    }
</style>

<script>
    $(document).ready(function () {
        function card_format(x) {
            if (x != null && x != '') {
                return '<span class="gc-card-chip"><i class="fa fa-credit-card text-primary" style="margin-right: 5px;"></i><strong>' + x + '</strong></span>';
            }
            return '';
        }

        function balance_format(x) {
            var val = parseFloat(x);
            if (isNaN(val) || val <= 0) {
                return '<span class="badge" style="background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; padding: 4px 8px; font-weight: 600;">' + currencyFormat(x) + ' (Agotada)</span>';
            } else {
                return '<span class="badge" style="background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; padding: 4px 10px; font-weight: 700; font-size: 12px;">' + currencyFormat(x) + '</span>';
            }
        }

        function expiry_format(x) {
            if (x != null && x != '') {
                var expDate = new Date(x);
                var now = new Date();
                var isExpired = expDate < now;
                if (isExpired) {
                    return '<span class="text-danger" style="font-weight: 600;" title="Tarjeta Vencida"><i class="fa fa-exclamation-triangle"></i> ' + fsd(x) + '</span>';
                } else {
                    return '<span style="color: #334155;"><i class="fa fa-calendar-check-o text-muted"></i> ' + fsd(x) + '</span>';
                }
            }
            return '<span class="text-muted">Sin Vencimiento</span>';
        }

        $('#GCData').dataTable({
            "aaSorting": [[3, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('sales/getGiftCards') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [
                { "bSortable": false, "mRender": checkbox },
                { "mRender": card_format },
                { "mRender": currencyFormat },
                { "mRender": balance_format },
                null,
                null,
                { "mRender": expiry_format },
                { "bSortable": false }
            ]
        });
    });
</script>

<!-- KPI Cards -->
<div class="row" style="margin-top: 10px;">
    <div class="col-sm-6 col-md-3">
        <div class="gc-kpi-card" title="Total de tarjetas emitidas históricamente">
            <div class="gc-kpi-info">
                <h4><?= number_format($total_cards, 0, ',', '.') ?></h4>
                <span>Tarjetas Emitidas</span>
            </div>
            <div class="gc-kpi-icon kpi-icon-purple">
                <i class="fa fa-gift"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="gc-kpi-card" title="Saldo total disponible en tarjetas para canje">
            <div class="gc-kpi-info">
                <h4 style="color: #15803d;"><?= $this->sma->formatMoney($total_avail_bal) ?></h4>
                <span>Saldo Activo Disponible</span>
            </div>
            <div class="gc-kpi-icon kpi-icon-green">
                <i class="fa fa-credit-card"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="gc-kpi-card" title="Tarjetas de regalo con saldo vigente">
            <div class="gc-kpi-info">
                <h4><?= number_format($active_cards, 0, ',', '.') ?></h4>
                <span>Tarjetas con Saldo</span>
            </div>
            <div class="gc-kpi-icon kpi-icon-blue">
                <i class="fa fa-check-circle-o"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="gc-kpi-card" title="Tarjetas consumidas totalmente">
            <div class="gc-kpi-info">
                <h4><?= number_format($empty_cards, 0, ',', '.') ?></h4>
                <span>Tarjetas Agotadas</span>
            </div>
            <div class="gc-kpi-icon kpi-icon-slate">
                <i class="fa fa-check-square-o"></i>
            </div>
        </div>
    </div>
</div>

<?= admin_form_open('sales/gift_card_actions', 'id="action-form"') ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-gift"></i><?= lang('gift_cards') ?></h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang('actions') ?>"></i>
                    </a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li>
                            <a href="<?php echo admin_url('sales/add_gift_card'); ?>" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus"></i> <?= lang('add_gift_card') ?>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="excel" data-action="export_excel">
                                <i class="fa fa-file-excel-o"></i> <?= lang('export_to_excel') ?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" id="delete" data-action="delete">
                                <i class="fa fa-trash-o"></i> <?= lang('delete_gift_cards') ?>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="gift-cards-header-bar">
                    <div class="gift-cards-title-wrap">
                        <h3><i class="fa fa-credit-card text-primary"></i> <?= lang('gift_cards'); ?></h3>
                        <p><?= lang('list_results'); ?> &bull; Emisión, recarga y control de saldo de tarjetas de regalo para clientes.</p>
                    </div>
                    <div>
                        <a href="<?= admin_url('sales/add_gift_card'); ?>" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm" style="border-radius: 6px; padding: 7px 15px; font-weight: 600;">
                            <i class="fa fa-plus-circle"></i> <?= lang('add_gift_card') ?>
                        </a>
                        <button type="button" class="btn btn-default btn-sm" onclick="$('#excel').click();" title="Exportar a Excel" style="border-radius: 6px; padding: 7px 12px;">
                            <i class="fa fa-file-excel-o text-success"></i> Exportar
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="GCData" class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkth" type="checkbox" name="check"/>
                            </th>
                            <th><?php echo $this->lang->line('card_no'); ?></th>
                            <th><?php echo $this->lang->line('value'); ?> (Inicial)</th>
                            <th><?php echo $this->lang->line('balance'); ?> (Disponible)</th>
                            <th><?php echo $this->lang->line('created_by'); ?></th>
                            <th><?php echo $this->lang->line('customer'); ?></th>
                            <th><?php echo $this->lang->line('expiry'); ?></th>
                            <th style="width:90px; text-align: center;"><?php echo $this->lang->line('actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="8" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<div style="display: none;">
    <input type="hidden" name="form_action" value="" id="form_action"/>
    <?= form_submit('submit', 'submit', 'id="action-form-submit"') ?>
</div>
<?= form_close() ?>

<script language="javascript">
    $(document).ready(function () {
        $('#delete').click(function (e) {
            e.preventDefault();
            $('#form_action').val($(this).attr('data-action'));
            $('#action-form-submit').trigger('click');
        });

        $('#excel').click(function (e) {
            e.preventDefault();
            $('#form_action').val($(this).attr('data-action'));
            $('#action-form-submit').trigger('click');
        });

        $('#pdf').click(function (e) {
            e.preventDefault();
            $('#form_action').val($(this).attr('data-action'));
            $('#action-form-submit').trigger('click');
        });
    });
</script>
