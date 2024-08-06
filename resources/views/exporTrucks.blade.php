<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Marca</th>
      <th>Placa</th>
      <th>Dueño</th>
      <th>Tolerancia delantera</th>
      <th>Tolerancia trasera</th>
      <th>Observaciones</th>
      <th>Creado</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($trucks as $truck)
    <tr>
      <td>{{$truck->id}}</td>
      <td>{{$truck->marca}}</td>
      <td>{{$truck->placa}}</td>
      <td>{{$truck->dueno}}</td>
      <td>{{$truck->tolerancia_delantera}}</td>
      <td>{{$truck->tolerancia_trasera}}</td>
      <td>{{$truck->observation}}</td>
      <td>{{$truck->user_name_insert}}</td>
    </tr>
    @endforeach
  </tbody>
</table>