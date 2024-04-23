<div>
    @if ($this->teams && sizeof($this->teams) > 0)
        @foreach ($this->teams as $single_team)
        <tr>
            <td>
              <a wire:navigate href="{{URL('teams/details/' . $single_team->slug)}}">
                <div class="d-flex px-3 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm font-bold">{{$single_team->name}}</h6>
                    </div>
                  </div>
              </a>
            </td>
            <td>
              <p class="text-xs font-bold mb-0">{{count($single_team->members)}}</p>
            </td>
         </tr>  
        @endforeach

        @else
        <td colspan="7">
          <div class="rounded flex items-center justify-center h-px-100 bg-light">
            <div class=""">
                <p class="m-0">No Teams</p>
              </div>
          </div>
        </td>
    @endif
</div>
