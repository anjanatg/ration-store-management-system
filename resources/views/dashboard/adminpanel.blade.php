@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

  <!-- Page heading -->
  <div class="d-flex justify-content-between align-items-start">
    <div>
      <h2 class="fw-bold">Dashboard</h2>
      <p class="text-secondary">Overview of your ration store management system</p>
    </div>
    <span class="text-secondary"><i class="bi bi-calendar3"></i> {{ now()->format('l, d F Y') }}</span>
  </div>

  <!-- ===== Summary cards ===== -->
  <div class="row g-3 mb-4">

    <div class="col-md-6 col-xl-3">
      <div class="stat-card blue">
        <i class="bi bi-people-fill stat-icon"></i>
        <div>
          <p>Total Customers</p>
          <h3>124</h3>
        </div>
        <small class="text-success w-100"><i class="bi bi-arrow-up"></i> 5 new this month</small>
      </div>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="stat-card green">
        <i class="bi bi-box-seam stat-icon"></i>
        <div>
          <p>Total Products</p>
          <h3>32</h3>
        </div>
        <small class="text-success w-100"><i class="bi bi-arrow-up"></i> 2 new this month</small>
      </div>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="stat-card purple">
        <i class="bi bi-database-fill stat-icon"></i>
        <div>
          <p>Available Stock</p>
          <h3>5,680 kg / L</h3>
        </div>
        <small class="text-success w-100"><i class="bi bi-arrow-up"></i> 8% from last month</small>
      </div>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="stat-card orange">
        <i class="bi bi-truck stat-icon"></i>
        <div>
          <p>Monthly Distributions</p>
          <h3>892</h3>
        </div>
        <small class="text-success w-100"><i class="bi bi-arrow-up"></i> 15% from last month</small>
      </div>
    </div>

  </div>

  <!-- ===== Chart + Low stock ===== -->
  <div class="row g-3 mb-4">

    <!-- Monthly distribution chart (plain CSS bars) -->
    <div class="col-lg-7">
      <div class="box">
        <h5 class="fw-bold mb-4">Monthly Distribution</h5>

        <div class="d-flex">
          <div class="chart-numbers">
            <span>1,000</span><span>800</span><span>600</span><span>400</span><span>200</span><span>0</span>
          </div>

          <!-- bar height % = value / 1000 -->
          <div class="chart-bars">
            <div class="bar-wrap"><div class="bar" style="height: 50%"></div><small>Apr 2025</small></div>
            <div class="bar-wrap"><div class="bar" style="height: 47%"></div><small>May 2025</small></div>
            <div class="bar-wrap"><div class="bar" style="height: 53%"></div><small>Jun 2025</small></div>
            <div class="bar-wrap"><div class="bar" style="height: 69%"></div><small>Jul 2025</small></div>
            <div class="bar-wrap"><div class="bar" style="height: 63%"></div><small>Aug 2025</small></div>
            <div class="bar-wrap"><div class="bar" style="height: 60%"></div><small>Sep 2025</small></div>
            <div class="bar-wrap"><div class="bar" style="height: 52%"></div><small>Oct 2025</small></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Low stock alerts -->
    <div class="col-lg-5">
      <div class="box">
        <div class="d-flex justify-content-between mb-3">
          <h5 class="fw-bold"><i class="bi bi-exclamation-triangle-fill text-danger"></i> Low Stock Alerts</h5>
          <a href="#" class="text-decoration-none">View All</a>
        </div>

        <table class="table table-sm align-middle">
          <thead class="table-light">
            <tr><th>Product</th><th>Current Stock</th><th>Minimum Level</th><th></th></tr>
          </thead>
          <tbody>
            <tr><td>Sugar</td><td class="text-danger">12 kg</td><td class="text-danger">50 kg</td><td><i class="bi bi-chevron-right"></i></td></tr>
            <tr><td>Cooking Oil</td><td class="text-danger">5 L</td><td class="text-danger">20 L</td><td><i class="bi bi-chevron-right"></i></td></tr>
            <tr><td>Wheat Flour</td><td>18 kg</td><td class="text-danger">50 kg</td><td><i class="bi bi-chevron-right"></i></td></tr>
            <tr><td>Kerosene Oil</td><td class="text-danger">8 L</td><td class="text-danger">30 L</td><td><i class="bi bi-chevron-right"></i></td></tr>
            <tr><td>Tea Powder</td><td>15 kg</td><td class="text-danger">40 kg</td><td><i class="bi bi-chevron-right"></i></td></tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <!-- ===== Recent distributions + Quick actions ===== -->
  <div class="row g-3">

    <!-- Recent distributions -->
    <div class="col-lg-7">
      <div class="box">
        <div class="d-flex justify-content-between mb-3">
          <h5 class="fw-bold"><i class="bi bi-truck"></i> Recent Distributions</h5>
          <a href="#" class="text-decoration-none">View All</a>
        </div>

        <div class="table-responsive">
          <table class="table table-sm align-middle">
            <thead class="table-light">
              <tr><th>Date</th><th>Customer</th><th>Products</th><th>Operator</th><th>Status</th></tr>
            </thead>
            <tbody>
              <tr><td>23 Oct 2025</td><td>Lakshmi K.</td><td>Rice (10 kg), Wheat (5 kg)</td><td>Suresh</td><td><span class="badge bg-success-subtle text-success">Completed</span></td></tr>
              <tr><td>22 Oct 2025</td><td>Rajesh P.</td><td>Rice (10 kg), Sugar (2 kg)</td><td>Anitha</td><td><span class="badge bg-success-subtle text-success">Completed</span></td></tr>
              <tr><td>22 Oct 2025</td><td>Priya S.</td><td>Wheat (5 kg), Oil (1 L)</td><td>Suresh</td><td><span class="badge bg-success-subtle text-success">Completed</span></td></tr>
              <tr><td>21 Oct 2025</td><td>Mohan T.</td><td>Rice (10 kg)</td><td>Anitha</td><td><span class="badge bg-success-subtle text-success">Completed</span></td></tr>
              <tr><td>21 Oct 2025</td><td>Meena R.</td><td>Sugar (2 kg), Tea (1 kg)</td><td>Suresh</td><td><span class="badge bg-success-subtle text-success">Completed</span></td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Quick actions -->
    <div class="col-lg-5">
      <div class="box">
        <h5 class="fw-bold mb-3"><i class="bi bi-lightning-charge"></i> Quick Actions</h5>

        <div class="row g-3">
          <div class="col-6">
            <a href="#" class="action-card blue">
              <i class="bi bi-box-seam-fill"></i>
              <span>Add Product</span>
            </a>
          </div>
          <div class="col-6">
            <a href="#" class="action-card green">
              <i class="bi bi-people-fill"></i>
              <span>Register Customer</span>
            </a>
          </div>
          <div class="col-6">
            <a href="#" class="action-card purple">
              <i class="bi bi-database-fill"></i>
              <span>Stock Entry</span>
            </a>
          </div>
          <div class="col-6">
            <a href="#" class="action-card orange">
              <i class="bi bi-truck"></i>
              <span>New Distribution</span>
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>

@endsection