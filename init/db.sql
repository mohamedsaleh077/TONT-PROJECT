-- ============= tables creation =================
-- lookup tables
CREATE TABLE IF NOT EXISTS statues
(
    id         INT(11) AUTO_INCREMENT,
    name       VARCHAR(255) NOT NULL UNIQUE,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS roles
(
    id         INT(11) AUTO_INCREMENT,
    name       VARCHAR(255) NOT NULL UNIQUE, -- ex: teachers, students, parents, admins, etc

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS subjects
(
    id         INT(11) AUTO_INCREMENT,
    name       VARCHAR(255)  NOT NULL UNIQUE, -- ex: math, english, etc
    code       VARCHAR(10)   NOT NULL UNIQUE, -- ex: cs101, eng, etc
    high_score DECIMAL(5, 2) NOT NULL,
    low_score  DECIMAL(5, 2) NOT NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS grades
(
    id         INT(11) AUTO_INCREMENT,
    level      INT(3)       NOT NULL UNIQUE, -- ex: from 1 to 12
    name       VARCHAR(255) NOT NULL UNIQUE, -- ex: 1st, 2nd, etc
    `group`    VARCHAR(255) NOT NULL,        -- ex: primary, secondary, etc

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS states
(
    id         INT(11) AUTO_INCREMENT,
    name       VARCHAR(255) NOT NULL UNIQUE,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS behaviour_types
(
    id         INT(11) AUTO_INCREMENT,
    name       VARCHAR(255) NOT NULL UNIQUE, -- 'Positive', 'Negative', 'Disruptive'
    points     INT(3)   DEFAULT 0,           -- ex: Positive = +5, Negative = -5

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id)
);
-- ------------------ main static data ----------------
-- school table
CREATE TABLE IF NOT EXISTS schools
(
    id          INT(11) AUTO_INCREMENT, -- school code
    school_name VARCHAR(255) NOT NULL,
    states_id   int(11)      NOT NULL,
    -- we can add more info about schools later

    created_at  DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at  DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    FOREIGN KEY (states_id) REFERENCES states (id) ON DELETE RESTRICT
);

-- admins table - for validation and fast query for community and students reports
CREATE TABLE IF NOT EXISTS admins
(
    id         INT(11) AUTO_INCREMENT,
    name       VARCHAR(255) NOT NULL,
    role_id    INT(11)      NOT NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id)
);
-- paretns table
CREATE TABLE IF NOT EXISTS parents
(
    id        INT(11) AUTO_INCREMENT,
    fullname  VARCHAR(255) NOT NULL,
    nation_id VARCHAR(14)  NOT NULL UNIQUE,

    PRIMARY KEY (id)
);

-- student table
CREATE TABLE IF NOT EXISTS students
(
    id                INT(11) AUTO_INCREMENT, -- student code
    fullname          VARCHAR(255) NOT NULL,
    school_id         INT(11)      NOT NULL,
    grade             VARCHAR(3)   NOT NULL,  -- number between 1 to 12
    student_nation_id VARCHAR(14)  NOT NULL UNIQUE,
    parent_id         INT(11)      NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (school_id) REFERENCES schools (id) ON DELETE CASCADE,
    FOREIGN KEY (parent_id) REFERENCES parents (id) ON DELETE CASCADE
);

-- teachers table
CREATE TABLE IF NOT EXISTS teachers
(
    id        INT(11) AUTO_INCREMENT, -- teacher code
    fullname  VARCHAR(255) NOT NULL,
    school_id INT(11)      NOT NULL,
    subject   VARCHAR(50)  NOT NULL,
    nation_id VARCHAR(14)  NOT NULL,  -- for checking account creation only right now

    PRIMARY KEY (id),
    FOREIGN KEY (school_id) REFERENCES schools (id) ON DELETE CASCADE
);

# paretns table
# CREATE TABLE IF NOT EXISTS parents
# (
#     id         INT(11) AUTO_INCREMENT,
#     fullname   VARCHAR(255)       NOT NULL,
#     nation_id  VARCHAR(14) UNIQUE NOT NULL,
#     gender     ENUM ('m', 'f')    NOT NULL,
#
#     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
#     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
#
#     PRIMARY KEY (id)
# );
#
# -- student table
# CREATE TABLE IF NOT EXISTS students
# (
#     id                INT(11) AUTO_INCREMENT, -- student code
#     fullname          VARCHAR(255)       NOT NULL,
#     school_id         INT(11)            NOT NULL,
#     student_nation_id VARCHAR(14) UNIQUE NOT NULL,
#     grade_id          INT(11)            NULL,
#
#     created_at        DATETIME DEFAULT CURRENT_TIMESTAMP,
#     updated_at        DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
#
#     PRIMARY KEY (id),
#     FOREIGN KEY (school_id) REFERENCES schools (id) ON DELETE RESTRICT,
#     FOREIGN KEY (grade_id) REFERENCES grades (id) ON DELETE RESTRICT
# );
#
# -- teachers table
# CREATE TABLE IF NOT EXISTS teachers
# (
#     id         INT(11) AUTO_INCREMENT,      -- teacher code
#     fullname   VARCHAR(255)       NOT NULL,
#     school_id  INT(11)            NOT NULL,
#     nation_id  VARCHAR(14) UNIQUE NOT NULL, -- for checking account creation only right now
#
#     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
#     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
#
#     PRIMARY KEY (id),
#     FOREIGN KEY (school_id) REFERENCES schools (id) ON DELETE RESTRICT
# );

-- many-to-many relations for users
CREATE TABLE IF NOT EXISTS student_parents
(
    student_id INT(11) NOT NULL,
    parent_id  INT(11) NOT NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (student_id, parent_id),
    FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE RESTRICT,
    FOREIGN KEY (parent_id) REFERENCES parents (id) ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS teacher_subjects
(
    teacher_id INT(11) NOT NULL,
    subject_id INT(11) NOT NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (teacher_id, subject_id),
    FOREIGN KEY (teacher_id) REFERENCES teachers (id) ON DELETE RESTRICT,
    FOREIGN KEY (subject_id) REFERENCES subjects (id) ON DELETE RESTRICT
);

-- student grades table
CREATE TABLE IF NOT EXISTS students_grade_history
(
    id         INT(11) AUTO_INCREMENT,
    student_id INT(11)     NOT NULL,
    year       VARCHAR(10) NOT NULL,
    status_id  INT(11)     NOT NULL,
    grade_id   INT(11)     NOT NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE,
    FOREIGN KEY (status_id) REFERENCES states (id) ON DELETE RESTRICT, -- this table will be created later
    FOREIGN KEY (grade_id) REFERENCES grades (id) ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS students_subjects_history_of_year
(
    year_id    INT(11)       NOT NULL,
    subject_id INT(11)       NOT NULL,
    score      DECIMAL(5, 2) NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (year_id, subject_id),
    FOREIGN KEY (subject_id) REFERENCES subjects (id) ON DELETE RESTRICT,
    FOREIGN KEY (year_id) REFERENCES students_grade_history (id) ON DELETE CASCADE
);

-- many-to-many relations for schools
CREATE TABLE IF NOT EXISTS school_grades
(
    school_id  INT(11) NOT NULL,
    grade_id   INT(11) NOT NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (school_id, grade_id),
    FOREIGN KEY (school_id) REFERENCES schools (id) ON DELETE CASCADE,
    FOREIGN KEY (grade_id) REFERENCES grades (id) ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS school_subjects
(
    school_id  INT(11) NOT NULL,
    subject_id INT(11) NOT NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (school_id, subject_id),
    FOREIGN KEY (school_id) REFERENCES schools (id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects (id) ON DELETE RESTRICT
);
-- ---------------------- users and authentications -------------
-- users table - for validation and fast query for community and students reports
CREATE TABLE IF NOT EXISTS users
(
    id              INT(11) AUTO_INCREMENT,

    -- Auth data
    email           VARCHAR(255) NOT NULL UNIQUE,
    pwd             VARCHAR(255) NOT NULL, -- hashed

    -- for legacy code
    nation_id       VARCHAR(14)  NULL,
    role            ENUM('student', 'teacher', 'parent', 'sudo') NOT NULL DEFAULT 'student',

    -- The "ref_id" you were talking about (The Link)
    role_id         INT(11)      NULL, -- ex: 1 = 'student', 2 = 'teacher'
    ref_id          INT(11)      NOT NULL, -- ex: 101 (The ID from students/teachers table)

    -- 2fa
    2fa_secret      TEXT         NULL,
    2fa_is_active   BOOLEAN      NOT NULL DEFAULT FALSE,

    -- Profile customization
    profile_picture VARCHAR(255) DEFAULT 'default.jpg',
    bio             VARCHAR(255) NULL,

    -- Logging
    created_at      DATETIME              DEFAULT CURRENT_TIMESTAMP,
    updated_at      DATETIME              DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE RESTRICT,

    UNIQUE (role_id, ref_id)
);

INSERT INTO `roles` (`name`)
VALUES ('sudo');
# INSERT INTO `roles` (`name`)
# VALUES ('mother');
# INSERT INTO `roles` (`name`)
# VALUES ('father');
# INSERT INTO `roles` (`name`)
# VALUES ('student');
# INSERT INTO `roles` (`name`)
# VALUES ('teacher');
INSERT INTO admins (`name`, `role_id`)
VALUES ('The Main Admin (SUDO)', '1');

-- tokens
CREATE TABLE IF NOT EXISTS auth_tokens
(
    id             INT(11) AUTO_INCREMENT,
    user_id        INT(11)      NOT NULL,

    selector       VARCHAR(255) NOT NULL UNIQUE,
    validator_hash VARCHAR(255) NOT NULL,
    expires_at     DATETIME     NOT NULL,

    ip_address     VARCHAR(45)  NULL,
    user_agent     TEXT         NULL,
    location_data  VARCHAR(255) NULL,

    created_at     DATETIME DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);

-- ---------------------- students reports --------------------
CREATE TABLE IF NOT EXISTS absence
(
    id           INT(11) AUTO_INCREMENT,
    student_id   INT(11) NOT NULL,
    teacher_id   INT(11) NOT NULL, -- will get teacher name and subject by joining
    absence_date DATE    NOT NULL,
    notes        TEXT,

    PRIMARY KEY (id),
    FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE,
    FOREIGN KEY (teacher_id) REFERENCES teachers (id) ON DELETE CASCADE,

    UNIQUE (student_id, absence_date, teacher_id)
);

-- exams table
CREATE TABLE IF NOT EXISTS exams
(
    id           INT(11) AUTO_INCREMENT,
    student_id   INT(11)      NOT NULL,
    teacher_id   INT(11)      NOT NULL, -- will get teacher name and subject by joining
    subject      VARCHAR(50)  NOT NULL,
    exam_title   VARCHAR(255) NOT NULL,
    full_mark    INT(3)       NOT NULL,
    student_mark INT(3)       NOT NULL,
    exam_date    DATE         NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE,
    FOREIGN KEY (teacher_id) REFERENCES teachers (id) ON DELETE CASCADE
);

-- behaviour table
CREATE TABLE IF NOT EXISTS behaviour
(
    id              INT(11) AUTO_INCREMENT,
    student_id      INT(11)      NOT NULL,
    teacher_id      INT(11)      NOT NULL, -- will get teacher name and subject by joining
    behaviour_type  VARCHAR(255) NOT NULL,
    behaviour_notes TEXT         NULL,
    behaviour_date  DATE         NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE,
    FOREIGN KEY (teacher_id) REFERENCES teachers (id) ON DELETE CASCADE
);

# -- absence table
# CREATE TABLE IF NOT EXISTS absence
# (
#     id           INT(11) AUTO_INCREMENT,
#     student_id   INT(11) NOT NULL,
#     teacher_id   INT(11) NULL,     -- will get teacher name and subject by joining
#     subject_id   INT(11) NOT NULL, -- from subjects table
#     absence_date DATE    NOT NULL,
#     notes        TEXT,
#
#     created_at   DATETIME DEFAULT CURRENT_TIMESTAMP,
#     updated_at   DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
#
#     PRIMARY KEY (id),
#     FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE,
#     FOREIGN KEY (teacher_id) REFERENCES teachers (id) ON DELETE SET NULL,
#
#     FOREIGN KEY (subject_id) REFERENCES subjects (id) ON DELETE RESTRICT,
#
#     UNIQUE (student_id, absence_date, subject_id)
# );
#
# -- exams table
# CREATE TABLE IF NOT EXISTS exams
# (
#     id            INT(11) AUTO_INCREMENT,
#     student_id    INT(11)       NOT NULL,
#     teacher_id    INT(11)       NULL,     -- will get teacher name and subject by joining
#     subject_id    INT(11)       NOT NULL, -- from subjects table
#     grade_year_id INT(11)       NOT NULL, -- from students_grade_history table
#     exam_title    VARCHAR(255)  NOT NULL,
#     full_mark     DECIMAL(5, 2) NOT NULL,
#     student_mark  DECIMAL(5, 2) NOT NULL,
#     exam_date     DATE          NOT NULL,
#
#     created_at    DATETIME DEFAULT CURRENT_TIMESTAMP,
#     updated_at    DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
#
#     PRIMARY KEY (id),
#     FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE,
#     FOREIGN KEY (teacher_id) REFERENCES teachers (id) ON DELETE SET NULL,
#
#     FOREIGN KEY (subject_id) REFERENCES subjects (id) ON DELETE RESTRICT,
#     FOREIGN KEY (grade_year_id) REFERENCES students_grade_history (id) ON DELETE CASCADE
# );
#
# -- behaviour table
# CREATE TABLE IF NOT EXISTS behaviour
# (
#     id                INT(11) AUTO_INCREMENT,
#     student_id        INT(11) NOT NULL,
#     teacher_id        INT(11) NULL, -- will get teacher name and subject by joining
#     behaviour_type_id INT(11) NOT NULL,
#     behaviour_notes   TEXT    NOT NULL,
#     behaviour_date    DATE    NOT NULL,
#
#     created_at        DATETIME DEFAULT CURRENT_TIMESTAMP,
#     updated_at        DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
#
#     PRIMARY KEY (id),
#     FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE,
#     FOREIGN KEY (teacher_id) REFERENCES teachers (id) ON DELETE SET NULL,
#
#     FOREIGN KEY (behaviour_type_id) REFERENCES behaviour_types (id) ON DELETE RESTRICT
# );


-- ---------------------- community ---------------------------
-- lookup tables
CREATE TABLE IF NOT EXISTS tags
(
    id         INT(11) AUTO_INCREMENT,
    name       VARCHAR(100) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

-- posts table
CREATE TABLE IF NOT EXISTS posts
(
    id           INT(11) AUTO_INCREMENT,
    user_id      INT(11)      NOT NULL,
    school_id    INT(11)      NULL,
    post_type    VARCHAR(50)  NOT NULL, -- students QA/ parent QA/ school annucement
    post_subject VARCHAR(255) NOT NULL,
    post_body    TEXT,
    media        VARCHAR(255),
    created_at   DATETIME DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (school_id) REFERENCES schools (id) ON DELETE CASCADE
);


-- M-M tables
CREATE TABLE IF NOT EXISTS post_tags
(
    post_id    INT(11) NOT NULL,
    tag_id     INT(11) NOT NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (post_id, tag_id),
    FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags (id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS saved_posts
(
    user_id    INT(11) NOT NULL,
    post_id    INT(11) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, post_id),
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE
);

-- reporting
CREATE TABLE IF NOT EXISTS reports
(
    id          INT(11) AUTO_INCREMENT,
    reporter_id INT(11)                  NOT NULL,

    entity_type ENUM ('post', 'comment') NOT NULL,
    entity_id   INT(11)                  NOT NULL,

    reason      TEXT                     NOT NULL,
    status      ENUM ('pending', 'resolved', 'ignored') DEFAULT 'pending',

    created_at  DATETIME                                DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (reporter_id) REFERENCES users (id) ON DELETE CASCADE
);

-- comments table
CREATE TABLE IF NOT EXISTS comments
(
    id           INT(11) AUTO_INCREMENT,
    user_id      INT(11) NOT NULL,
    post_id      INT(11) NOT NULL,
    comment_text TEXT    NOT NULL,
    media        VARCHAR(255),
    created_at   DATETIME DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE
);

-- reactions
CREATE TABLE IF NOT EXISTS post_likes
(
    user_id    INT(11) NOT NULL,
    post_id    INT(11) NOT NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (user_id, post_id),
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE
);

-- notifications
CREATE TABLE IF NOT EXISTS notifications
(
    id           INT AUTO_INCREMENT,
    recipient_id INT(11)                                    NOT NULL,
    actor_id     INT(11)                                    NULL,

    entity_type  ENUM ('post', 'comment', 'like', 'report') NOT NULL,
    entity_id    INT(11)                                    NOT NULL,

    notify_type  VARCHAR(50)                                NOT NULL, -- 'new_comment', 'new_like', 'new_post'
    is_read      BOOLEAN  DEFAULT FALSE,

    created_at   DATETIME DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id),

    FOREIGN KEY (actor_id) REFERENCES users (id) ON DELETE SET NULL,
    FOREIGN KEY (recipient_id) REFERENCES users (id) ON DELETE CASCADE
);

-- following system
CREATE TABLE IF NOT EXISTS post_followers
(
    user_id    INT NOT NULL,
    post_id    INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (user_id, post_id),
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE
);

-- ==================== Indexing (Improved) ====================
-- Auth & Users
CREATE INDEX idx_auth_tokens_selector ON auth_tokens (selector);
CREATE INDEX idx_users_role_ref ON users (role_id, ref_id);

-- Main Entities (Names)
CREATE INDEX idx_students_fullname ON students (fullname);
CREATE INDEX idx_teachers_fullname ON teachers (fullname);
CREATE INDEX idx_parents_fullname ON parents (fullname);

-- Student History & Reports
CREATE INDEX idx_history_student ON students_grade_history (student_id);
CREATE INDEX idx_scores_history ON students_subjects_history_of_year (year_id);
CREATE INDEX idx_abs_student_date ON absence (student_id, absence_date);
CREATE INDEX idx_exams_student_date ON exams (student_id, exam_date);
CREATE INDEX idx_beh_student_date ON behaviour (student_id, behaviour_date);

-- Community Feed
CREATE INDEX idx_posts_school_type ON posts (school_id, post_type, created_at);
CREATE INDEX idx_comm_post_date ON comments (post_id, created_at);
CREATE INDEX idx_posts_user_date ON posts (user_id, created_at);

-- Community Others
CREATE INDEX idx_notif_recipient_unread ON notifications (recipient_id, is_read, created_at);
CREATE INDEX idx_reports_entity ON reports (entity_type, entity_id, status);

-- Search
ALTER TABLE posts
    ADD FULLTEXT idx_post_search (post_subject, post_body);

-- i have no idea why the host hate arabic
ALTER TABLE `posts`
    MODIFY `post_subject` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    MODIFY `post_body` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;
