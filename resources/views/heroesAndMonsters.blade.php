@extends('layout')

@section('content')

<article class="feature-card mb-3">
    <h1>Challenge 4: Heroes and Monsters</h1>
</article>

{{-- Start the action section --}}
<section class="upload-main-card feature-card mt-3">
    <h2>Start the action!</h2>

    <form method="get" action="/demonstrate">
        <button type="submit" class="btn btn-primary">Start the battle</button>
    </form>
</section>

{{-- Display the events --}}
@if($events)
    <section class="upload-main-card feature-card mt-3">
        @foreach($events as $event)
            <div>{{ $event }}</div>
        @endforeach
    </section>
@endif


{{-- Description of the task --}}
<section class="upload-main-card feature-card mt-3">

<section>
    <h2>Challenge description</h2>
    <p style="text-align: justify;">
        The main focus of the assignment is Object-Oriented Programming (OOP). You are expected to 
        implement key OOP concepts such as inheritance, polymorphism, exception handling, and the 
        Singleton design pattern. Optionally, you may also include additional design patterns such 
        as the Factory Method or the Decorator pattern if they improve your solution.
    </p>
</section>

<section style="text-align: center;">
    <img 
        src="images/heroes.png" 
        alt="Illustration of the heroes and monsters game" 
        style="width: 50%; max-width: 100%; height: auto; margin-top: 20px; margin-bottom: 20px;"
    >
</section>

<section>
    <h5>Game Description</h5>
    <p style="text-align: justify;">
        The goal of this assignment is to build a simple game simulation involving heroes, weapons, 
        and monsters. The game should demonstrate proper use of object-oriented design principles 
        through interactions between these entities.
    </p>
</section>

<section>
    <h5>Heroes</h5>
    <p style="text-align: justify;">
        There are two types of heroes in the game. The first type is the Wizard, who starts with 150 
        health points, and the second type is the Swordsman, who starts with 100 health points. Each 
        hero is capable of picking up weapons, dropping weapons, and storing weapons in a backpack. 
        However, only one weapon can be active at any given time.
    </p>
</section>

<section>
    <h5>Weapons</h5>
    <p style="text-align: justify;">
        The game includes three types of weapons. The Sword and the Spear cannot be used by the Wizard, 
        and attempting to do so should result in an exception being thrown. The Spell weapon is exclusive 
        to the Wizard, meaning only the Wizard can learn and use it.
    </p>
</section>

<section>
    <h5>Backpack System</h5>
    <p style="text-align: justify;">
        Each hero has a backpack that is used to store weapons. A hero can store a maximum of two 
        weapons in their backpack. Only one weapon may be active at a time, and weapons are switched 
        based on their index within the backpack. If a hero attempts to switch weapons while their 
        backpack is empty, a NoWeapon exception must be thrown. Additionally, if a hero tries to add 
        more than two weapons to their backpack, an exception must also be thrown.
    </p>
</section>

<section>
    <h5>Weapon Interaction</h5>
    <p style="text-align: justify;">
        Heroes are able to drop weapons during the game. When a weapon is dropped, another hero can 
        pick it up. When this happens, the original hero should automatically switch to another available 
        weapon from their backpack, if one exists.
    </p>
</section>

<section>
    <h5>Monsters</h5>
    <p style="text-align: justify;">
        The game features two types of monsters: Dragons and Spiders. Each monster has a set of 
        possible attacks, and the specific attack used is determined randomly during combat.
    </p>
    <p style="text-align: justify;">
        A Dragon can either perform a strike that deals 5 damage or use a fire breath attack that 
        deals 20 damage. A Spider can either perform a strike that deals 5 damage or bite its target, 
        dealing 8 damage.
    </p>
</section>

<section>
    <h5>Combat System</h5>
    <p style="text-align: justify;">
        Combat between a hero and a monster is simulated using a random number generator that produces 
        a value between 0 and 100. If the generated number is below 50, the hero performs an attack. 
        If the number is above 50, the monster performs an attack. The battle continues until either 
        the hero or the monster reaches zero health, at which point the remaining participant is 
        declared the winner.
    </p>
</section>

<section>
    <h5>Hero Attacks</h5>
    <p style="text-align: justify;">
        Heroes deal damage to monsters depending on their type and the weapon they are using. A 
        Wizard using a Spell deals 20 damage. A Swordsman using a Sword deals 10 damage, while a 
        Swordsman using a Spear deals 15 damage.
    </p>
</section>

<section>
    <h5>Simulation Requirements</h5>
    <p style="text-align: justify;">
        The simulation must include both combat and weapon interaction systems. You are required to 
        simulate battles between heroes and monsters using the defined combat rules. Additionally, 
        you must simulate the process of heroes picking up and dropping weapons, including interactions 
        where one hero drops a weapon and another hero picks it up.
    </p>
</section>

<section>
    <h5>Logging</h5>
    <p style="text-align: justify;">
        The system must log all important events to a file. Every attack must be recorded, including 
        the attacker, the victim, and the weapon used, following the format similar like this: 
        [attacker] attacked [victim] using [weapon]. Whenever a hero picks up a weapon, it must be 
        logged in a format similar like this: [hero] picked up weapon [weapon]. Finally, when a winner 
        is determined, the result must be logged.
    </p>
</section>

</section>




@endsection