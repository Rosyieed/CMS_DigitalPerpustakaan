@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'REN - Digital Perpustakaan')
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
