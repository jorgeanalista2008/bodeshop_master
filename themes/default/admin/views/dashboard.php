<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
function row_status($x)
{
    if ($x == null) {
        return '';
    } elseif ($x == 'pending') {
        return '<div class="text-center"><span class="label label-warning">' . lang($x) . '</span></div>';
    } elseif ($x == 'completed' || $x == 'paid' || $x == 'sent' || $x == 'received') {
        return '<div class="text-center"><span class="label label-success">' . lang($x) . '</span></div>';
    } elseif ($x == 'partial' || $x == 'transferring') {
        return '<div class="text-center"><span class="label label-info">' . lang($x) . '</span></div>';
    } elseif ($x == 'due') {
        return '<div class="text-center"><span class="label label-danger">' . lang($x) . '</span></div>';
    }
    return '<div class="text-center"><span class="label label-default">' . lang($x) . '</span></div>';
}
?>

<!-- 1. Executive Welcome Header -->
<div class="dashboard-welcome-banner">
    <div class="row" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
        <div class="col-sm-7" style="margin-bottom: 8px;">
            <h1 class="welcome-title"><i class="fa fa-tachometer text-primary" style="margin-right: 8px;"></i><?= lang('dashboard'); ?></h1>
            <p class="welcome-subtitle"><?= $Settings->site_name; ?> &bull; <?= date('l, d F Y'); ?></p>
        </div>
        <div class="col-sm-5 text-right" style="margin-bottom: 8px;">
            <a href="<?= admin_url('pos'); ?>" class="btn btn-success btn-action-banner" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none;">
                <i class="fa fa-th" style="margin-right: 5px;"></i> Ir al POS
            </a>
            <?php if ($Owner || $Admin || $GP['sales-add']) { ?>
                <a href="<?= admin_url('sales/add'); ?>" class="btn btn-primary btn-action-banner" style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); border: none;">
                    <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <?= lang('add_sale'); ?>
                </a>
            <?php } ?>
        </div>
    </div>
</div>

<!-- 2. Executive Top KPI Cards -->
<?php if ($Owner || $Admin) { ?>
<div class="row" style="margin-bottom: 10px;">
    <!-- KPI 1: Inventory Value -->
    <div class="col-lg-3 col-sm-6">
        <div class="modern-kpi-card kpi-emerald">
            <div class="kpi-icon-wrapper">
                <i class="fa fa-cubes"></i>
            </div>
            <div class="kpi-info">
                <span class="kpi-label"><?= lang('stock_value'); ?> (Venta)</span>
                <h3 class="kpi-value"><?= $this->sma->formatMoney($stock->stock_by_price ?? 0); ?></h3>
                <span class="kpi-subtext"><i class="fa fa-tag"></i> Costo: <?= $this->sma->formatMoney($stock->stock_by_cost ?? 0); ?></span>
            </div>
        </div>
    </div>

    <!-- KPI 2: Recent Sales Records -->
    <div class="col-lg-3 col-sm-6">
        <div class="modern-kpi-card kpi-blue">
            <div class="kpi-icon-wrapper">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="kpi-info">
                <span class="kpi-label"><?= lang('latest_five'); ?> <?= lang('sales'); ?></span>
                <h3 class="kpi-value"><?= !empty($sales) ? count($sales) : 0; ?> <small style="font-size: 13px; font-weight: 600; color: #64748b;">registros</small></h3>
                <span class="kpi-subtext"><a href="<?= admin_url('sales'); ?>" style="color: #2563eb; text-decoration: none;"><i class="fa fa-arrow-right"></i> Ver todas las ventas</a></span>
            </div>
        </div>
    </div>

    <!-- KPI 3: Best Seller Product -->
    <div class="col-lg-3 col-sm-6">
        <div class="modern-kpi-card kpi-amber">
            <div class="kpi-icon-wrapper">
                <i class="fa fa-trophy"></i>
            </div>
            <div class="kpi-info">
                <span class="kpi-label"><?= lang('best_seller'); ?></span>
                <h3 class="kpi-value" style="font-size: 16px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?= !empty($bs) ? htmlspecialchars($bs[0]->product_name) : 'N/A'; ?>">
                    <?= !empty($bs) ? character_limiter($bs[0]->product_name, 18) : 'N/A'; ?>
                </h3>
                <span class="kpi-subtext"><i class="fa fa-check-circle" style="color: #059669;"></i> <?= !empty($bs) ? (int)$bs[0]->quantity : 0; ?> un. vendidas</span>
            </div>
        </div>
    </div>

    <!-- KPI 4: Contacts Portfolio -->
    <div class="col-lg-3 col-sm-6">
        <div class="modern-kpi-card kpi-violet">
            <div class="kpi-icon-wrapper">
                <i class="fa fa-users"></i>
            </div>
            <div class="kpi-info">
                <span class="kpi-label"><?= lang('customers'); ?> / <?= lang('suppliers'); ?></span>
                <h3 class="kpi-value"><?= !empty($customers) ? count($customers) : 0; ?> <small style="font-size: 13px; font-weight: 600; color: #64748b;">/ <?= !empty($suppliers) ? count($suppliers) : 0; ?></small></h3>
                <span class="kpi-subtext"><i class="fa fa-address-book-o"></i> Cartera activa</span>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- 3. Modern Quick Action Grid -->
<div class="row" style="margin-bottom: 20px;">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <h2><i class="fa fa-th"></i><span class="break"></span><?= lang('quick_links') ?></h2>
            </div>
            <div class="box-content" style="padding: 16px 20px;">
                <div class="modern-quick-grid">
                    <?php if ($Owner || $Admin || $GP['products-index']) { ?>
                        <a class="modern-quick-item theme-blue" href="<?= admin_url('products') ?>">
                            <div class="quick-icon-box"><i class="fa fa-barcode"></i></div>
                            <span class="quick-title"><?= lang('products') ?></span>
                        </a>
                    <?php } ?>

                    <?php if ($Owner || $Admin || $GP['sales-index']) { ?>
                        <a class="modern-quick-item theme-emerald" href="<?= admin_url('sales') ?>">
                            <div class="quick-icon-box"><i class="fa fa-shopping-cart"></i></div>
                            <span class="quick-title"><?= lang('sales') ?></span>
                        </a>
                    <?php } ?>

                    <?php if ($Owner || $Admin || $GP['quotes-index']) { ?>
                        <a class="modern-quick-item theme-amber" href="<?= admin_url('quotes') ?>">
                            <div class="quick-icon-box"><i class="fa fa-file-text-o"></i></div>
                            <span class="quick-title"><?= lang('quotes') ?></span>
                        </a>
                    <?php } ?>

                    <?php if ($Owner || $Admin || $GP['purchases-index']) { ?>
                        <a class="modern-quick-item theme-rose" href="<?= admin_url('purchases') ?>">
                            <div class="quick-icon-box"><i class="fa fa-truck"></i></div>
                            <span class="quick-title"><?= lang('purchases') ?></span>
                        </a>
                    <?php } ?>

                    <?php if ($Owner || $Admin || $GP['transfers-index']) { ?>
                        <a class="modern-quick-item theme-violet" href="<?= admin_url('transfers') ?>">
                            <div class="quick-icon-box"><i class="fa fa-exchange"></i></div>
                            <span class="quick-title"><?= lang('transfers') ?></span>
                        </a>
                    <?php } ?>

                    <?php if ($Owner || $Admin || $GP['customers-index']) { ?>
                        <a class="modern-quick-item theme-sky" href="<?= admin_url('customers') ?>">
                            <div class="quick-icon-box"><i class="fa fa-users"></i></div>
                            <span class="quick-title"><?= lang('customers') ?></span>
                        </a>
                    <?php } ?>

                    <?php if ($Owner || $Admin || $GP['suppliers-index']) { ?>
                        <a class="modern-quick-item theme-slate" href="<?= admin_url('suppliers') ?>">
                            <div class="quick-icon-box"><i class="fa fa-building-o"></i></div>
                            <span class="quick-title"><?= lang('suppliers') ?></span>
                        </a>
                    <?php } ?>

                    <?php if ($Owner || $Admin || $GP['notifications-index']) { ?>
                        <a class="modern-quick-item theme-yellow" href="<?= admin_url('notifications') ?>">
                            <div class="quick-icon-box"><i class="fa fa-bell-o"></i></div>
                            <span class="quick-title"><?= lang('notifications') ?></span>
                        </a>
                    <?php } ?>

                    <?php if ($Owner) { ?>
                        <a class="modern-quick-item theme-indigo" href="<?= admin_url('auth/users') ?>">
                            <div class="quick-icon-box"><i class="fa fa-user-circle-o"></i></div>
                            <span class="quick-title"><?= lang('users') ?></span>
                        </a>
                        <a class="modern-quick-item theme-zinc" href="<?= admin_url('system_settings') ?>">
                            <div class="quick-icon-box"><i class="fa fa-cogs"></i></div>
                            <span class="quick-title"><?= lang('settings') ?></span>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4. Overview Chart Section -->
<?php if (($Owner || $Admin) && $chatData) {
    foreach ($chatData as $month_sale) {
        $months[]     = date('M-Y', strtotime($month_sale->month));
        $msales[]     = $month_sale->sales;
        $mtax1[]      = $month_sale->tax1;
        $mtax2[]      = $month_sale->tax2;
        $mpurchases[] = $month_sale->purchases;
        $mtax3[]      = $month_sale->ptax;
    } ?>
    <div class="box" style="margin-bottom: 20px;">
        <div class="box-header">
            <h2><i class="fa-fw fa fa-bar-chart-o"></i><?= lang('overview_chart'); ?></h2>
        </div>
        <div class="box-content">
            <div class="row">
                <div class="col-md-12">
                    <p class="introtext" style="color: #64748b; font-size: 13.5px;"><?php echo lang('overview_chart_heading'); ?></p>
                    <div id="ov-chart" style="width:100%; height:450px;"></div>
                    <p class="text-center" style="font-size: 12px; color: #94a3b8; margin-top: 8px;"><?= lang('chart_lable_toggle'); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- 5. Latest Five Activities Tabbed Hub -->
<div class="row" style="margin-bottom: 20px;">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h2><i class="fa-fw fa fa-tasks"></i><?= lang('latest_five') ?></h2>
            </div>
            <div class="box-content" style="padding: 20px;">
                <div class="row">
                    <div class="col-md-12">
                        <ul id="dbTab" class="nav nav-tabs">
                            <?php if ($Owner || $Admin || $GP['sales-index']) { ?>
                                <li class="active"><a href="#sales" data-toggle="tab"><i class="fa fa-shopping-cart" style="margin-right: 6px;"></i><?= lang('sales') ?></a></li>
                            <?php } if ($Owner || $Admin || $GP['quotes-index']) { ?>
                                <li><a href="#quotes" data-toggle="tab"><i class="fa fa-file-text-o" style="margin-right: 6px;"></i><?= lang('quotes') ?></a></li>
                            <?php } if ($Owner || $Admin || $GP['purchases-index']) { ?>
                                <li><a href="#purchases" data-toggle="tab"><i class="fa fa-truck" style="margin-right: 6px;"></i><?= lang('purchases') ?></a></li>
                            <?php } if ($Owner || $Admin || $GP['transfers-index']) { ?>
                                <li><a href="#transfers" data-toggle="tab"><i class="fa fa-exchange" style="margin-right: 6px;"></i><?= lang('transfers') ?></a></li>
                            <?php } if ($Owner || $Admin || $GP['customers-index']) { ?>
                                <li><a href="#customers" data-toggle="tab"><i class="fa fa-users" style="margin-right: 6px;"></i><?= lang('customers') ?></a></li>
                            <?php } if ($Owner || $Admin || $GP['suppliers-index']) { ?>
                                <li><a href="#suppliers" data-toggle="tab"><i class="fa fa-building-o" style="margin-right: 6px;"></i><?= lang('suppliers') ?></a></li>
                            <?php } ?>
                        </ul>

                        <div class="tab-content" style="padding-top: 10px;">
                            <?php if ($Owner || $Admin || $GP['sales-index']) { ?>
                            <div id="sales" class="tab-pane fade in active">
                                <div class="table-responsive">
                                    <table id="sales-tbl" class="table table-bordered table-hover table-striped" style="margin-bottom: 0;">
                                        <thead>
                                        <tr>
                                            <th style="width:35px !important;">#</th>
                                            <th><?= $this->lang->line('date'); ?></th>
                                            <th><?= $this->lang->line('reference_no'); ?></th>
                                            <th><?= $this->lang->line('customer'); ?></th>
                                            <th><?= $this->lang->line('status'); ?></th>
                                            <th><?= $this->lang->line('total'); ?></th>
                                            <th><?= $this->lang->line('payment_status'); ?></th>
                                            <th><?= $this->lang->line('paid'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($sales)) {
                                            $r = 1;
                                            foreach ($sales as $order) {
                                                echo '<tr id="' . $order->id . '" class="' . ($order->pos ? 'receipt_link' : 'invoice_link') . '"><td>' . $r . '</td>
                                                    <td>' . $this->sma->hrld($order->date) . '</td>
                                                    <td><span class="label label-info" style="font-weight: 600;">' . $order->reference_no . '</span></td>
                                                    <td><strong>' . $order->customer . '</strong></td>
                                                    <td>' . row_status($order->sale_status) . '</td>
                                                    <td class="text-right font-weight-bold" style="font-weight: 700;">' . $this->sma->formatMoney($order->grand_total) . '</td>
                                                    <td>' . row_status($order->payment_status) . '</td>
                                                    <td class="text-right text-success" style="font-weight: 700; color: #059669;">' . $this->sma->formatMoney($order->paid) . '</td>
                                                </tr>';
                                                $r++;
                                            }
                                        } else { ?>
                                            <tr>
                                                <td colspan="8" class="dataTables_empty text-center"><?= lang('no_data_available') ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php } ?>

                            <?php if ($Owner || $Admin || $GP['quotes-index']) { ?>
                            <div id="quotes" class="tab-pane fade">
                                <div class="table-responsive">
                                    <table id="quotes-tbl" class="table table-bordered table-hover table-striped" style="margin-bottom: 0;">
                                        <thead>
                                        <tr>
                                            <th style="width:35px !important;">#</th>
                                            <th><?= $this->lang->line('date'); ?></th>
                                            <th><?= $this->lang->line('reference_no'); ?></th>
                                            <th><?= $this->lang->line('customer'); ?></th>
                                            <th><?= $this->lang->line('status'); ?></th>
                                            <th><?= $this->lang->line('amount'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($quotes)) {
                                            $r = 1;
                                            foreach ($quotes as $quote) {
                                                echo '<tr id="' . $quote->id . '" class="quote_link"><td>' . $r . '</td>
                                                    <td>' . $this->sma->hrld($quote->date) . '</td>
                                                    <td><span class="label label-info" style="font-weight: 600;">' . $quote->reference_no . '</span></td>
                                                    <td><strong>' . $quote->customer . '</strong></td>
                                                    <td>' . row_status($quote->status) . '</td>
                                                    <td class="text-right" style="font-weight: 700;">' . $this->sma->formatMoney($quote->grand_total) . '</td>
                                                </tr>';
                                                $r++;
                                            }
                                        } else { ?>
                                            <tr>
                                                <td colspan="6" class="dataTables_empty text-center"><?= lang('no_data_available') ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php } ?>

                            <?php if ($Owner || $Admin || $GP['purchases-index']) { ?>
                            <div id="purchases" class="tab-pane fade">
                                <div class="table-responsive">
                                    <table id="purchases-tbl" class="table table-bordered table-hover table-striped" style="margin-bottom: 0;">
                                        <thead>
                                        <tr>
                                            <th style="width:35px !important;">#</th>
                                            <th><?= $this->lang->line('date'); ?></th>
                                            <th><?= $this->lang->line('reference_no'); ?></th>
                                            <th><?= $this->lang->line('supplier'); ?></th>
                                            <th><?= $this->lang->line('status'); ?></th>
                                            <th><?= $this->lang->line('amount'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($purchases)) {
                                            $r = 1;
                                            foreach ($purchases as $purchase) {
                                                echo '<tr id="' . $purchase->id . '" class="purchase_link"><td>' . $r . '</td>
                                                    <td>' . $this->sma->hrld($purchase->date) . '</td>
                                                    <td><span class="label label-info" style="font-weight: 600;">' . $purchase->reference_no . '</span></td>
                                                    <td><strong>' . $purchase->supplier . '</strong></td>
                                                    <td>' . row_status($purchase->status) . '</td>
                                                    <td class="text-right" style="font-weight: 700;">' . $this->sma->formatMoney($purchase->grand_total) . '</td>
                                                </tr>';
                                                $r++;
                                            }
                                        } else { ?>
                                            <tr>
                                                <td colspan="6" class="dataTables_empty text-center"><?= lang('no_data_available') ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php } ?>

                            <?php if ($Owner || $Admin || $GP['transfers-index']) { ?>
                            <div id="transfers" class="tab-pane fade">
                                <div class="table-responsive">
                                    <table id="transfers-tbl" class="table table-bordered table-hover table-striped" style="margin-bottom: 0;">
                                        <thead>
                                        <tr>
                                            <th style="width:35px !important;">#</th>
                                            <th><?= $this->lang->line('date'); ?></th>
                                            <th><?= $this->lang->line('reference_no'); ?></th>
                                            <th><?= $this->lang->line('from'); ?></th>
                                            <th><?= $this->lang->line('to'); ?></th>
                                            <th><?= $this->lang->line('status'); ?></th>
                                            <th><?= $this->lang->line('amount'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($transfers)) {
                                            $r = 1;
                                            foreach ($transfers as $transfer) {
                                                echo '<tr id="' . $transfer->id . '" class="transfer_link"><td>' . $r . '</td>
                                                    <td>' . $this->sma->hrld($transfer->date) . '</td>
                                                    <td><span class="label label-info" style="font-weight: 600;">' . $transfer->transfer_no . '</span></td>
                                                    <td>' . $transfer->from_warehouse_name . '</td>
                                                    <td>' . $transfer->to_warehouse_name . '</td>
                                                    <td>' . row_status($transfer->status) . '</td>
                                                    <td class="text-right" style="font-weight: 700;">' . $this->sma->formatMoney($transfer->grand_total) . '</td>
                                                </tr>';
                                                $r++;
                                            }
                                        } else { ?>
                                            <tr>
                                                <td colspan="7" class="dataTables_empty text-center"><?= lang('no_data_available') ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php } ?>

                            <?php if ($Owner || $Admin || $GP['customers-index']) { ?>
                            <div id="customers" class="tab-pane fade">
                                <div class="table-responsive">
                                    <table id="customers-tbl" class="table table-bordered table-hover table-striped" style="margin-bottom: 0;">
                                        <thead>
                                        <tr>
                                            <th style="width:35px !important;">#</th>
                                            <th><?= $this->lang->line('company'); ?></th>
                                            <th><?= $this->lang->line('name'); ?></th>
                                            <th><?= $this->lang->line('email'); ?></th>
                                            <th><?= $this->lang->line('phone'); ?></th>
                                            <th><?= $this->lang->line('address'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($customers)) {
                                            $r = 1;
                                            foreach ($customers as $customer) {
                                                echo '<tr id="' . $customer->id . '" class="customer_link pointer"><td>' . $r . '</td>
                                                    <td><strong>' . $customer->company . '</strong></td>
                                                    <td>' . $customer->name . '</td>
                                                    <td>' . $customer->email . '</td>
                                                    <td>' . $customer->phone . '</td>
                                                    <td>' . $customer->address . '</td>
                                                </tr>';
                                                $r++;
                                            }
                                        } else { ?>
                                            <tr>
                                                <td colspan="6" class="dataTables_empty text-center"><?= lang('no_data_available') ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php } ?>

                            <?php if ($Owner || $Admin || $GP['suppliers-index']) { ?>
                            <div id="suppliers" class="tab-pane fade">
                                <div class="table-responsive">
                                    <table id="suppliers-tbl" class="table table-bordered table-hover table-striped" style="margin-bottom: 0;">
                                        <thead>
                                        <tr>
                                            <th style="width:35px !important;">#</th>
                                            <th><?= $this->lang->line('company'); ?></th>
                                            <th><?= $this->lang->line('name'); ?></th>
                                            <th><?= $this->lang->line('email'); ?></th>
                                            <th><?= $this->lang->line('phone'); ?></th>
                                            <th><?= $this->lang->line('address'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($suppliers)) {
                                            $r = 1;
                                            foreach ($suppliers as $supplier) {
                                                echo '<tr id="' . $supplier->id . '" class="supplier_link pointer"><td>' . $r . '</td>
                                                    <td><strong>' . $supplier->company . '</strong></td>
                                                    <td>' . $supplier->name . '</td>
                                                    <td>' . $supplier->email . '</td>
                                                    <td>' . $supplier->phone . '</td>
                                                    <td>' . $supplier->address . '</td>
                                                </tr>';
                                                $r++;
                                            }
                                        } else { ?>
                                            <tr>
                                                <td colspan="6" class="dataTables_empty text-center"><?= lang('no_data_available') ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 6. Best Sellers Charts Section -->
<?php if (($Owner || $Admin) && ($bs || $lmbs)) { ?>
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-sm-6">
            <div class="box">
                <div class="box-header">
                    <h2><i class="fa-fw fa fa-line-chart"></i><?= lang('best_sellers'), ' (' . date('M-Y', time()) . ')'; ?></h2>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="bschart" style="width:100%; height:420px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box">
                <div class="box-header">
                    <h2><i class="fa-fw fa fa-line-chart"></i><?= lang('best_sellers') . ' (' . date('M-Y', strtotime('-1 month')) . ')'; ?></h2>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="lmbschart" style="width:100%; height:420px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('.order').click(function () {
            window.location.href = '<?=admin_url()?>orders/view/' + $(this).attr('id') + '#comments';
        });
        $('.invoice').click(function () {
            window.location.href = '<?=admin_url()?>orders/view/' + $(this).attr('id');
        });
        $('.quote').click(function () {
            window.location.href = '<?=admin_url()?>quotes/view/' + $(this).attr('id');
        });
    });
</script>

<?php if (($Owner || $Admin) && $chatData) { ?>
    <style type="text/css" media="screen">
        .tooltip-inner {
            max-width: 500px;
        }
    </style>
    <script src="<?= $assets; ?>js/hc/highcharts.js"></script>
    <script type="text/javascript">
        $(function () {
            Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
                return {
                    radialGradient: {cx: 0.5, cy: 0.3, r: 0.7},
                    stops: [[0, color], [1, Highcharts.Color(color).brighten(-0.3).get('rgb')]]
                };
            });
            $('#ov-chart').highcharts({
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
                            var s = '<div class="well well-sm hc-tip" style="margin-bottom:0;"><h2 style="margin-top:0;">' + this.x + '</h2><table class="table table-striped"  style="margin-bottom:0;">';
                            $.each(this.points, function () {
                                s += '<tr><td style="color:{series.color};padding:0">' + this.series.name + ': </td><td style="color:{series.color};padding:0;text-align:right;"> <b>' +
                                currencyFormat(this.y) + '</b></td></tr>';
                            });
                            s += '</table></div>';
                            return s;
                        }
                    },
                    useHTML: true, borderWidth: 0, shadow: false, valueDecimals: site.settings.decimals,
                    style: {fontSize: '14px', padding: '0', color: '#000000'}
                },
                series: [{
                    type: 'column',
                    name: '<?= lang('sp_tax'); ?>',
                    data: [<?php echo implode(', ', $mtax1); ?>]
                },
                {
                    type: 'column',
                    name: '<?= lang('order_tax'); ?>',
                    data: [<?php echo implode(', ', $mtax2); ?>]
                },
                {
                    type: 'column',
                    name: '<?= lang('sales'); ?>',
                    data: [<?php echo implode(', ', $msales); ?>]
                }, {
                    type: 'spline',
                    name: '<?= lang('purchases'); ?>',
                    data: [<?php echo implode(', ', $mpurchases); ?>],
                    marker: {
                        lineWidth: 2,
                        states: {
                            hover: {
                                lineWidth: 4
                            }
                        },
                        lineColor: Highcharts.getOptions().colors[3],
                        fillColor: 'white'
                    }
                }, {
                    type: 'spline',
                    name: '<?= lang('pp_tax'); ?>',
                    data: [<?php echo implode(', ', $mtax3); ?>],
                    marker: {
                        lineWidth: 2,
                        states: {
                            hover: {
                                lineWidth: 4
                            }
                        },
                        lineColor: Highcharts.getOptions().colors[3],
                        fillColor: 'white'
                    }
                }, {
                    type: 'pie',
                    name: '<?= lang('stock_value'); ?>',
                    data: [
                        ['', 0],
                        ['', 0],
                        ['<?= lang('stock_value_by_price'); ?>', <?php echo $stock->stock_by_price ?? 0; ?>],
                        ['<?= lang('stock_value_by_cost'); ?>', <?php echo $stock->stock_by_cost ?? 0; ?>],
                    ],
                    center: [80, 42],
                    size: 80,
                    showInLegend: false,
                    dataLabels: {
                        enabled: false
                    }
                }]
            });
        });
    </script>
<?php } ?>

<?php if (($Owner || $Admin) && ($bs || $lmbs)) { ?>
    <script type="text/javascript">
        $(function () {
            <?php if ($lmbs) { ?>
            $('#lmbschart').highcharts({
                chart: {type: 'column'},
                title: {text: ''},
                credits: {enabled: false},
                xAxis: {type: 'category', labels: {rotation: -60, style: {fontSize: '13px'}}},
                yAxis: {min: 0, title: {text: ''}},
                legend: {enabled: false},
                series: [{
                    name: '<?=lang('sold'); ?>',
                    data: [<?php
                    foreach ($lmbs as $r) {
                        if ($r->quantity > 0) {
                            echo "['" . addSlashes($r->product_name) . '<br>(' . $r->product_code . ")', " . $r->quantity . '],';
                        }
                    } ?>],
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#000',
                        align: 'right',
                        y: -25,
                        style: {fontSize: '12px'}
                    }
                }]
            });
            <?php } ?>

            <?php if ($bs) { ?>
            $('#bschart').highcharts({
                chart: {type: 'column'},
                title: {text: ''},
                credits: {enabled: false},
                xAxis: {type: 'category', labels: {rotation: -60, style: {fontSize: '13px'}}},
                yAxis: {min: 0, title: {text: ''}},
                legend: {enabled: false},
                series: [{
                    name: '<?=lang('sold'); ?>',
                    data: [<?php
                    foreach ($bs as $r) {
                        if ($r->quantity > 0) {
                            echo "['" . addSlashes($r->product_name) . '<br>(' . $r->product_code . ")', " . $r->quantity . '],';
                        }
                    } ?>],
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#000',
                        align: 'right',
                        y: -25,
                        style: {fontSize: '12px'}
                    }
                }]
            });
            <?php } ?>
        });
    </script>
<?php } ?>
