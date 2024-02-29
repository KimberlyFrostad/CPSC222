import pwd
import grp
from flask import Flask, request, jsonify

app = Flask(__name__)

#user name and password as instructed from assignment on canvas
USERNAME = "test"
PASSWORD = "abcABC123"

# authentication for the user name and password
def authenticate(username, password):
    return username == USERNAME and password == PASSWORD

# finding and getting the users
def get_users():
    users = {}
    for user in pwd.getpwall():
        users[user.pw_uid] = user.pw_name
    return users

# finding and getting the groups
def get_groups():
    groups = {}
    for group in grp.getgrall():
        groups[group.gr_gid] = group.gr_name
    return groups

# Users endpoint
@app.route('/api/users', methods=['POST'])
def users():
    auth = request.authorization
    if not auth or not authenticate(auth.username, auth.password):
        return jsonify({'error': 'Unauthorized access'}), 401

    return jsonify(get_users())

# Groups endpoint
@app.route('/api/groups', methods=['POST'])
def groups():
    auth = request.authorization
    if not auth or not authenticate(auth.username, auth.password):
        return jsonify({'error': 'Unauthorized access'}), 401

    return jsonify(get_groups())

if __name__ == '__main__':
    app.run(host='localhost', port=3000)
#python3 pythonapi.py
#after all of the apache stuff I didnt have to run the above anymore and the curl command works without the :3000 as it's supposed to
#curl -X POST -u test:abcABC123 http://localhost:3000/api/users
#curl -X POST -u test:abcABC123 http://localhost:3000/api/groups
#use the commands above in seperate terminals to run the code to get the list of users/groups
