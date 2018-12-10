

<div class="card shadow">
    <h2 style="margin-left: -15px;">Social Media</h2>

    <ul class="list-inline mb-0" style="margin-left: -20px;">
        <li class="list-inline-item mr-3">
            <a href="#">
                <i class="fab fa-facebook fa-2x fa-fw" style="font-size: 45px;"></i>
            </a>
        </li>
        <li class="list-inline-item mr-3">
            <a href="#">
                <i class="fab fa-twitter-square fa-2x fa-fw" style="font-size: 45px;"></i>
            </a>
        </li>
        <li class="list-inline-item">
            <a href="#">
                <i class="fab fa-instagram fa-2x fa-fw" style="font-size: 45px;"></i>
            </a>
        </li>
    </ul>
</div>

<br>
<br>

<div class="card shadow">
    <h2 style="margin-left: -15px;">Contactformulier</h2>
    <form>
        <div class="form-group row">
            <label for="name" class=" col-form-label">Naam</label>
            <input type="text" class="form-control" id="name" value="">
        </div>
        <div class="form-group row">
            <label for="email" class="col-form-label">E-mail</label>
            <input type="email" class="form-control" id="email" placeholder="email@email.nl">
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-form-label">Onderwerp</label>
            <select class="mdb-select form-control">
                <option value="" disabled>Choose option</option>
                <option value="1" selected>Feedback</option>
                <option value="2">Report a bug</option>
                <option value="3">Feature request</option>
            </select>
        </div>
        <div class="form-group row">
            <label for="message" class="col-form-label">Bericht</label>
            <textarea type="text" id="message" class="form-control md-textarea" rows="3"></textarea>
        </div>
    </form>
</div>

