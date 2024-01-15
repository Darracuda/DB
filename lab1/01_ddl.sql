create sequence if not exists genre_id_seq increment 1 start 100;
create sequence if not exists country_id_seq increment 1 start 100;
create sequence if not exists movie_id_seq increment 1 start 100;
create sequence if not exists person_id_seq increment 1 start 100;
create sequence if not exists crew_position_id_seq increment 1 start 100;
create sequence if not exists crew_id_seq increment 1 start 100;

create table if not exists genre
(
    id bigint not null default nextval('genre_id_seq'),
    name text not null,

    constraint genre_pk primary key (id)
);

create table if not exists country
(
    id bigint not null default nextval('country_id_seq'),
    name text not null,

    constraint country_pk primary key (id)
);

create table if not exists movie
(
    id bigint not null default nextval('movie_id_seq'),
    name text not null,
    country_id bigint not null,
    release_date date not null,
    genre_id bigint not null,

    constraint movie_pk primary key (id),
    constraint movie_country_id_fk foreign key (country_id)
        references country (id),
    constraint movie_genre_id_fk foreign key (genre_id)
        references genre (id)
);

create table if not exists person
(
    id bigint not null default nextval('person_id_seq'),
    first_name text not null,
    last_name text not null,
    country_id bigint not null,
    date_of_birth date not null,
    date_of_death date,

    constraint person_pk primary key (id),
    constraint person_country_id_fk foreign key (country_id)
        references country (id)
);

create table if not exists crew_position
(
    id bigint not null default nextval('crew_position_id_seq'),
    name text not null,

    constraint crew_position_pk primary key (id)
);

create table if not exists crew
(
    id bigint not null default nextval('crew_id_seq'),
    person_id bigint not null,
    crew_position_id bigint not null,
    movie_id bigint not null,
    role text,

    constraint crew_pk primary key (id),
    constraint crew_movie_id_fk foreign key (movie_id)
        references movie (id),
    constraint crew_person_id_fk foreign key (person_id)
        references person (id),
    constraint crew_position_id_fk foreign key (crew_position_id)
        references crew_position (id)
);
