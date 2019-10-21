<h1>Description</h1>
<p>This application is a simple quiz, which gives you 10 random quotes and you have to guess the author. It has two different modes: binary (yes or no) and multiple choices. When the quiz is complete, statistics page is shown to the user. There he or she can see all the answers and  scores.
The application works like this: 10 random quotes with their authors are pulled form the database and are saved in an associative array ‘question_set’, which is a session variable. We also get 1 or 2 wrong answers (depending on the mode) from the database every time the question page is refreshed. The other session variable is ‘question_number’, which is used to access a specific member of a ‘question_set’ array. Its value is set to 0 when the quiz starts, and is incremented by 1 every time the user guesses the author. After answering a question, users answer in asynchronously directed to a script, which decides whether the answer is correct or wrong and then returns the appropriate response. It also adds a key ‘status’ with a value of either ‘correct’ or ‘wrong’ to the specific question in the ‘question_set’. After all 10 questions have been answered and value of ‘question_number’ is greater then 9, user is redirected to statistics page, where all the questions with their statuses and correct answers are displayed.
</p>

<h2>Database Structure</h2>

<p>
Applications database consists of 2 tables: ‘quotes’ and ‘authors’. ‘quotes’ contains a foreign key called ‘author_id’ which is connected to the ‘id’ field of ‘authors’ table. It is a simple ‘one to many’ relation (a quote belongs to an author, and an author has many quotes).
The database is represented in the application as a class ‘Database’. It holds all the variables needed for establishing a connection as it’s private properties. And it has a method connect(), which returns a database connection object.
</p>

Models
<h2>Database Structure</h2>

<p>
Each database table is represented by a model class in the application. Both models have constructors, which inject database connection object into them. They also have different public methods, that are used to interact with the database.
The Quote model has only one method: randomQuotes(). This method returns an associative array of ten random quotes and their authors from the database.
There are two methods for the Author model, each for a different mode:
binary_IncorrectAnswer($correct_answer) – This method returns one random author. The argument is author of currently displayed quote and it is needed so that the method doesn’t return the same author.
multiple_IncorrectAnswers($correct_answer) – This is similar to the previous method. The only difference is that it returns an array of two authors.
</p>

Sessions
<h2>Database Structure</h2>

<p>
The session variables play a big role in this application. The whole application is build around them. 4 session variables are used throughout the code: ‘mode’, ‘correct_answers’, ‘questions_set’ and ‘question_number’.
‘mode’ keeps track of what application mode the user has chosen. It is destroyed every time the settings menu is loaded, or when the user restarts the quiz. When a new quiz is started, the script checks for this variable. If it does not exist, it creates a new one, so it matches the selected mode. After that ‘correct_answers’ and ‘question_number’ are set to zero and a new collection of random quotes is assigned to ‘question_set’. Meaning that we have to request the quotes from the database only once. After that the data is kept and manipulated on the server, until the session is reset. 
</p>