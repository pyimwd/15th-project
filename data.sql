-- INSERT DATA

INSERT `collecting` (name, modified_at, created_at)
VALUES ('anime', '2022-01-01 00:00:00', '2022-01-01 00:00:00');

INSERT `collecting` (name, modified_at, created_at)
VALUES ('manga', '2022-01-01 00:00:00', '2022-01-01 00:00:00');

INSERT `category` (name)
VALUES ('comedy');

INSERT `category` (name)
VALUES ('adventure');

INSERT `category` (name)
VALUES ('action');

INSERT `category` (name)
VALUES ('fantasy');

INSERT `category` (name)
VALUES ('thriller');

INSERT `category` (name)
VALUES ('drama');

INSERT `category` (name)
VALUES ('horror');

INSERT `category` (name)
VALUES ('romance');

INSERT `category` (name)
VALUES ('science-fiction');

INSERT `category` (name)
VALUES ('historical');

INSERT `category` (name)
VALUES ('mecha');

INSERT `category` (name)
VALUES ('sports');

INSERT `category` (name)
VALUES ('shonen');

INSERT `category` (name)
VALUES ('shojo');

INSERT `category` (name)
VALUES ('seinen');

INSERT `category` (name)
VALUES ('josei');

INSERT `item` (collecting_id, title, synopsis, volumes_or_episodes, start_date, end_date, image_url)
VALUES ('1', 'Kaze no Tani no Nausicaä', 'A millennium has passed since the catastrophic nuclear war named the "Seven Days of Fire," which destroyed nearly all life on Earth. Humanity now lives in a constant struggle against the treacherous jungle that has evolved in response to the destruction caused by mankind. Filled with poisonous spores and enormous insects, the jungle spreads rapidly across the Earth and threatens to swallow the remnants of the human race. Away from the jungle exists a peaceful farming kingdom known as the "Valley of the Wind," whose placement by the sea frees it from the spread of the jungle\'s deadly toxins. The Valley\'s charismatic young princess, Nausicaä, finds her tranquil kingdom disturbed when an airship from the kingdom of Tolmekia crashes violently in the Valley. After Nausicaä and the citizens of the Valley find a sinister pulsating object in the wreckage, the Valley is suddenly invaded by the Tolmekian military, who intend to revive a dangerous weapon from the Seven Days of Fire. Now Nausicaä must fight to stop the Tolmekians from plunging the Earth into a cataclysm which humanity could never survive, while also protecting the Valley from the encroaching forces of the toxic jungle.', '1', '1984-03-11 00:00:00', '1984-03-11 00:00:00', 'https://cdn.myanimelist.net/images/manga/3/156624.jpg?s=237768196e315e268bbf5709d52af55c');

INSERT `agency` (name, address, zip_code, city)
VALUES ('happy real estate', '38 rue de la paix', '37000', 'tours');

INSERT `user` (firstname, lastname, address, zip_code, city, country, `e-mail`, password, status)
VALUES ('jean', 'loquace', '8 boulevard du Parc', '75016', 'paris', 'france', 'j.loquace@gmail.com', 'loq1234?', 'actif');

INSERT `agency` (name, address, zip_code, city)
VALUES ('happy real estate', '38 rue de la paix', '37000', 'tours');

INSERT `user` (firstname, lastname, address, zip_code, city, country, `e-mail`, password, status)
VALUES ('jean', 'loquace', '8 boulevard du Parc', '75016', 'paris', 'france', 'j.loquace@gmail.com', 'loq1234?', 'actif');