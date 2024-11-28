<!-- resources/views/partials/latest-jobs.blade.php -->
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h3>Últimos 10 registros</h3>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>Estado</th>
                      <th>Timestamp</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($jobs as $job)
                      <tr>
                          <td>{{ ucfirst($job->state) }}</td>
                          <td>{{ $job->timestamp }}</td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>
</div>
