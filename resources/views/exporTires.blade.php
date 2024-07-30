<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>posicion</th>
      <th>KM_actutal</th>
      <th>Cantidad de llantas</th>
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
      <td>{{$truck->cantidad_llantas}}</td>
      <td>{{$truck->observation}}</td>
      <td>{{$truck->user_name_insert}}</td>
    </tr>
    @endforeach
  </tbody>
</table>