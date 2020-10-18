<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'SRNSFG')
<img src="https://rustaveli.org.ge/themes/images/logo.png" class="logo" alt="Rustaveli">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
