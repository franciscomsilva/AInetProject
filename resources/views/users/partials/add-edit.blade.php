{{csrf_field()}}
<div class="form-group">
    <label for="inputFullname">Name</label>
    <input
        type="text" class="form-control"
        name="name" id="inputName"
        placeholder="Name" value="{{old('name', $user->name)}}" />
</div>
<div class="form-group">
    <label for="inputFullname">Name</label>
    <input
            type="text" class="form-control"
            name="name" id="inputName"
            placeholder="Name" value="{{old('name', $user->name)}}" />
</div>
<div class="form-group">
    <label for="inputType">Type</label>
    <select name="type" id="inputType" class="form-control">
        <option disabled selected> -- select an option -- </option>
        <option <?= is_selected(old('type', $user->type), '0') ?> value="0">Administrator</option>
        <option <?= is_selected(old('type', $user->type), '1') ?> value="1">Publisher</option>
        <option <?= is_selected(old('type', $user->type), '2') ?> value="2">Client</option>
    </select>
</div>
<div class="form-group">
    <label for="inputEmail">Email</label>
    <input
        type="email" class="form-control"
        name="email" id="inputEmail"
        placeholder="Email address" value="{{old('email', $user->email)}}"/>
</div>
