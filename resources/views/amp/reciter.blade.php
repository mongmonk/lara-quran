<form class="sample-form" method="GET" action="{{ url()->current() }}" target="_top">
    <select name="audio" onchange="this.form.submit()">
        <option value="ar.alafasy" {{ request()->get('audio') == 'ar.alafasy' ? 'selected' : false }}>Alafasy</option>
        <option value="ar.abdulbasitmurattal" {{ request()->get('audio') == 'ar.abdulbasitmurattal' ? 'selected' : false }}>Abdulbasitmurattal</option>
        <option value="ar.abdullahbasfar" {{ request()->get('audio') == 'ar.abdullahbasfar' ? 'selected' : false }}>Abdullahbasfar</option>
        <option value="ar.abdulsamad" {{ request()->get('audio') == 'ar.abdulsamad' ? 'selected' : false }}>Abdulsamad</option>
        <option value="ar.abdurrahmaansudais" {{ request()->get('audio') == 'ar.abdurrahmaansudais' ? 'selected' : false }}>Abdurrahmaansudais</option>
        <option value="ar.ahmedajamy" {{ request()->get('audio') == 'ar.ahmedajamy' ? 'selected' : false }}>Ahmedajamy</option>                        
        <option value="ar.aymanswoaid" {{ request()->get('audio') == 'ar.aymanswoaid' ? 'selected' : false }}>Aymanswoaid</option>
        <option value="ar.hanirifai" {{ request()->get('audio') == 'ar.hanirifai' ? 'selected' : false }}>Hanirifai</option>
        <option value="ar.hudhaify" {{ request()->get('audio') == 'ar.hudhaify' ? 'selected' : false }}>Hudhaify</option>
        <option value="ar.husary" {{ request()->get('audio') == 'ar.husary' ? 'selected' : false }}>Husary</option>
        <option value="ar.husarymujawwad" {{ request()->get('audio') == 'ar.husarymujawwad' ? 'selected' : false }}>Husarymujawwad</option>
        <option value="ar.mahermuaiqly" {{ request()->get('audio') == 'ar.mahermuaiqly' ? 'selected' : false }}>Mahermuaiqly</option>
        <option value="ar.minshawimujawwad" {{ request()->get('audio') == 'ar.minshawimujawwad' ? 'selected' : false }}>Minshawimujawwad</option>
        <option value="ar.saoodshuraym" {{ request()->get('audio') == 'ar.saoodshuraym' ? 'selected' : false }}>Saoodshuraym</option>
        <option value="ar.shaatree" {{ request()->get('audio') == 'ar.shaatree' ? 'selected' : false }}>Shaatree</option>
    </select>
</form>