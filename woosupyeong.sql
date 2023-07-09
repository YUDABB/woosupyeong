create table users(
uid int not null auto_increment,
id varchar(255) not null,
password varchar(255) not null,
email varchar(255) not null,
name varchar(255) not null,
img longblob not null,
primary key(uid));

create table professor(
sub_id int not null auto_increment,
subject_name varchar(255) not null,
professor_name varchar(255) not null,
subject_value varchar(5) not null,
subject_content varchar(255) not null,
primary key(sub_id));

insert into users values (1,'master', '$2y$10$8QWj/OPBUas8c7NjJUJCV.kUhYTdZuLWZdiQQi/.PAF/24M4KVJFO', 'master@wsp.ac.kr', '관리자', '');

insert into professor values (1,'C프로그래밍기초', '백유진', '전공', 'ㅁㅁㅁ');
insert into professor values (2,'스마트기술', '윤여창', '전공', 'ㅁㅁㅁ');
insert into professor values (3,'보안자료구조', '이진선', '전공', 'ㅁㅁㅁ');
insert into professor values (4,'암호기술', '백유진', '전공', 'ㅁㅁㅁ');
insert into professor values (5,'Java프로그래밍', '최숙영', '전공', 'ㅁㅁㅁ');
insert into professor values (6,'네트워크기초와시뮬레이션', '이진선', '전공', 'ㅁㅁㅁ');
insert into professor values (7,'보안컴퓨터네트워크', '이성원', '전공', 'ㅁㅁㅁ');
insert into professor values (8,'웹서버구축및운영(캡스톤디자인)', '윤여창', '전공', 'ㅁㅁㅁ');
insert into professor values (9,'보안데이터베이스프로젝트', '윤여창', '전공', 'ㅁㅁㅁ');
insert into professor values (10,'웹어플리케이션보안', '이진선', '전공', 'ㅁㅁㅁ');
insert into professor values (11,'데이터분석과프로그래밍', '최숙영', '전공', 'ㅁㅁㅁ');
insert into professor values (12,'정보보호법', '최숙영', '전공', 'ㅁㅁㅁ');
insert into professor values (13,'모바일보안', '이성원', '전공', 'ㅁㅁㅁ');
insert into professor values (14,'침입차단및탐지', '백유진', '전공', 'ㅁㅁㅁ');
insert into professor values (15,'인공지능기초', '윤여창', '전공', 'ㅁㅁㅁ');
insert into professor values (16,'웹어플리케이션보안서비스러닝', '이진선', '전공', 'ㅁㅁㅁ');
insert into professor values (17,'인공지능앱제작기초', '이진선', '교양선택', 'ㅁㅁㅁ');
insert into professor values (18,'컴퓨팅 사고', '정인숙', '교양필수', 'ㅁㅁㅁ');
insert into professor values (19,'컴퓨팅 사고', '이진선', '교양필수', 'ㅁㅁㅁ');
insert into professor values (20,'컴퓨팅 사고', '박지현', '교양필수', 'ㅁㅁㅁ');
insert into professor values (21,'컴퓨팅 사고', '윤후병', '교양필수', 'ㅁㅁㅁ');
insert into professor values (22,'포토샵기초', '오정화', '자유선택', 'ㅁㅁㅁ');
insert into professor values (23,'마케팅조사', '권민택', '교양선택', 'ㅁㅁㅁ');
insert into professor values (24,'동영상콘텐츠와 소셜미디어', '김아미', '교양선택', 'ㅁㅁㅁ');
insert into professor values (25,'컴퓨팅 사고', '김아미', '교양필수', 'ㅁㅁㅁ');
insert into professor values (26,'MOS master', '박경숙', '자유선택', 'ㅁㅁㅁ');
insert into professor values (27,'MOS master', '이서윤', '자유선택', 'ㅁㅁㅁ');
insert into professor values (28,'다문화 사회의 이해', '양속목', '교양선택', 'ㅁㅁㅁ');
insert into professor values (29,'공감과 소통의 기술', '이영원', '교양선택', 'ㅁㅁㅁ');
insert into professor values (30,'현대사회와 규범', '박경순', '교양선택', 'ㅁㅁㅁ');
insert into professor values (31,'화학의세계', '이기승', '교양필수', 'ㅁㅁㅁ');
insert into professor values (32,'생활일본어', '송현순', '교양선택', 'ㅁㅁㅁ');
insert into professor values (33,'운동과 건강관리', '송남정', '교양선택', 'ㅁㅁㅁ');
insert into professor values (34,'설득의 기술', '임현빈', '교양선택', 'ㅁㅁㅁ');
insert into professor values (35,'4차산업혁명과 미래사회 지용승', '지용승', '교양선택', 'ㅁㅁㅁ');
insert into professor values (36,'글로벌 중국어', '이해우', '교양필수', 'ㅁㅁㅁ');
insert into professor values (37,'메타버스시대와 문화콘텐츠 전략', '박지현', '교양선택', 'ㅁㅁㅁ');
insert into professor values (39,'4차산업혁명과 미래사회 지용승', '이한규', '교양선택', 'ㅁㅁㅁ');
insert into professor values (40,'두레공동체', '김두규', '교양필수', 'ㅁㅁㅁ');
insert into professor values (41,'두레공동체', '이해우', '교양필수', 'ㅁㅁㅁ');
insert into professor values (42,'두레공동체', '홍미성', '교양필수', 'ㅁㅁㅁ');
insert into professor values (43,'수학의 세계', '강향임', '교양필수', 'ㅁㅁㅁ');
insert into professor values (44,'문화예술적 사고', '최정진', '교양필수', 'ㅁㅁㅁ');
insert into professor values (45,'생활법률', '조상혁', '교양선택', 'ㅁㅁㅁ');
insert into professor values (46,'논리비판적 사고', '문동규', '교양필수', 'ㅁㅁㅁ');
insert into professor values (47,'인체의 탐구', '김현주', '교양선택', 'ㅁㅁㅁ');
insert into professor values (48,'외국인을 위한 한국어 글쓰기', '김상영', '교양선택', 'ㅁㅁㅁ');
insert into professor values (49,'현대사회와 스포츠', '홍미성', '교양선택', 'ㅁㅁㅁ');
insert into professor values (50,'국제관계의 이해', '홍석빈', '교양선택', 'ㅁㅁㅁ');
insert into professor values (51,'동양의 역사와 문화', '신은경', '교양선택', 'ㅁㅁㅁ');
insert into professor values (52,'바다의 신비', '곽오열', '교양선택', 'ㅁㅁㅁ');
insert into professor values (53,'문화와 패션', '김경화', '교양선택', 'ㅁㅁㅁ');
insert into professor values (54,'인체의 탐구', '유윤조', '교양선택', 'ㅁㅁㅁ');
insert into professor values (55,'범죄와 형벌', '류지영', '교양선택', 'ㅁㅁㅁ');
insert into professor values (56,'서양의 역사와 문화', '권정기', '교양선택', 'ㅁㅁㅁ');
insert into professor values (57,'동양의 역사와 문화', '권정기', '교양선택', 'ㅁㅁㅁ');
insert into professor values (58,'스포츠와 법', '류지영', '교양선택', 'ㅁㅁㅁ');
insert into professor values (59,'취창업을 위한 우석CHANGE', '김진동', '자유선택', 'ㅁㅁㅁ');
insert into professor values (60,'현대 사회와 스포츠', '홍미성', '교양선택', 'ㅁㅁㅁ');
insert into professor values (61,'다문화 사회의 이해', '홍성하', '교양선택', 'ㅁㅁㅁ');
insert into professor values (62,'문화콘텐츠로 세상보기', '박문철', '교양선택', 'ㅁㅁㅁ');
insert into professor values (63,'경제와 시장', '홍석빈', '교양선택', 'ㅁㅁㅁ');
insert into professor values (64,'자아성찰과 자기성찰', '권정기', '교양선택', 'ㅁㅁㅁ');
insert into professor values (65,'자아성찰과 자기성찰', '김영혜', '교양선택', 'ㅁㅁㅁ');
insert into professor values (66,'창의융합적 사고', '한만성', '교양필수', 'ㅁㅁㅁ');
insert into professor values (67,'글로벌 중국어', '공번정', '교양필수', 'ㅁㅁㅁ');
insert into professor values (68,'생활 중국어', '공번정', '교양선택', 'ㅁㅁㅁ');
insert into professor values (69,'글쓰기', '박지윤', '교양필수', 'ㅁㅁㅁ');
insert into professor values (70,'글쓰기', '최강민', '교양필수', 'ㅁㅁㅁ');
insert into professor values (71,'글쓰기', '이재규', '교양필수', 'ㅁㅁㅁ');
insert into professor values (72,'글쓰기', '최정숙', '교양필수', 'ㅁㅁㅁ');
insert into professor values (73,'글로벌 영어', '브랜드', '교양필수', 'ㅁㅁㅁ');
insert into professor values (74,'글로벌 영어', '토마스', '교양필수', 'ㅁㅁㅁ');
insert into professor values (75,'일본문화의 이해', '송현순', '교양선택', 'ㅁㅁㅁ');
insert into professor values (76,'글로벌 영어', '크리스', '교양필수', 'ㅁㅁㅁ');
insert into professor values (77,'글로벌 영어', '마이클', '교양필수', 'ㅁㅁㅁ');
insert into professor values (78,'글로벌 영어', '마크', '교양필수', 'ㅁㅁㅁ');
insert into professor values (79,'글로벌 영어', '네이튼', '교양필수', 'ㅁㅁㅁ');
insert into professor values (80,'글로벌 영어', '스티븐', '교양필수', 'ㅁㅁㅁ');

create table evaluation(
id int not null auto_increment,
uid int not null,
e_name varchar(255) not null,
sub_id int not null,
dedate boolean,
group_task boolean,
announcement boolean,
report boolean,
exploration boolean,
exam boolean,
pf boolean,
onli boolean,
blen boolean,
cap boolean,
scope int not null,
content varchar(255) not null,
e_date date not null,
PRIMARY KEY (id),
FOREIGN KEY (uid) REFERENCES users(uid),
FOREIGN KEY (sub_id) REFERENCES professor(sub_id));

create table f_board(
b_id int not null auto_increment,
b_name varchar(255) not null,
b_title varchar(255) not null,
b_contents varchar(255) not null,
b_views int(11) not null,
b_date date not null,
uid int not null,
PRIMARY KEY (b_id),
FOREIGN KEY (uid) REFERENCES users(uid));

create table m_board(
m_id int not null auto_increment,
m_name varchar(255) not null,
m_title varchar(255) not null,
m_contents varchar(255) not null,
m_views int(11) not null,
m_date date not null,
uid int not null,
PRIMARY KEY (m_id),
FOREIGN KEY (uid) REFERENCES users(uid));

create table comment(
c_id int not null auto_increment,
c_name varchar(255) not null,
c_contents varchar(255) not null,
c_date date not null,
c_like_cnt int(11) default null,
uid int not null,
b_id int not null,
primary key(c_id),
FOREIGN KEY (uid,b_id) REFERENCES f_board(uid,b_id));

create table mcomment(
c_id int not null auto_increment,
c_name varchar(255) not null,
c_contents varchar(255) not null,
c_date date not null,
c_like_cnt int(11) default null,
uid int not null,
m_id int not null,
primary key(c_id),
FOREIGN KEY (uid,m_id) REFERENCES m_board(uid,m_id));

create table comment_like(
like_id int not null auto_increment,
b_id int not null,
c_id int not null,
uid int not null,
primary key(like_id),
FOREIGN KEY (uid,b_id,c_id) REFERENCES comment(uid,b_id,c_id));

create table mcomment_like(
like_id int not null auto_increment,
m_id int not null,
c_id int not null,
uid int not null,
primary key(like_id),
FOREIGN KEY (uid,m_id,c_id) REFERENCES mcomment(uid,m_id,c_id));