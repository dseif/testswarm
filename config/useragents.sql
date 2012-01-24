INSERT INTO `useragents` (`name`, `engine`, `version`, `os`, `active`, `current`, `popular`, `gbs`, `beta`, `mobile`, `popcorn`) VALUES

# Desktop Browsers

('Chrome', 'chrome', '.*', 'win7', 1, 1, 1, 1, 0, 0, 1),
('Chrome', 'chrome', '.*', 'osx', 1, 1, 1, 1, 0, 0, 1),
('Chrome', 'chrome', '.*', 'linux', 1, 1, 1, 1, 0, 0, 1),

('Firefox 3.6', 'gecko', '^1.9.2[0-9.]*$', 'win7', 1, 0, 1, 1, 0, 0, 1),
('Firefox 3.6', 'gecko', '^1.9.2[0-9.]*$', 'osx', 1, 0, 1, 1, 0, 0, 1),
('Firefox 3.6', 'gecko', '^1.9.2[0-9.]*$', 'linux', 1, 0, 1, 1, 0, 0, 1),
('Firefox 9', 'gecko', '^9.', 'win7', 1, 1, 1, 1, 0, 0, 1),
('Firefox 9', 'gecko', '^9.', 'osx', 1, 1, 1, 1, 0, 0, 1),
('Firefox 9', 'gecko', '^9.', 'linux', 1, 1, 1, 1, 0, 0, 1),
('Firefox 10', 'gecko', '^10.', 'win7', 1, 0, 0, 0, 1, 0, 1),
('Firefox 10', 'gecko', '^10.', 'osx', 1, 0, 0, 0, 1, 0, 1),
('Firefox 10', 'gecko', '^10.', 'linux', 1, 0, 0, 0, 1, 0, 1),

('Internet Explorer 9', 'msie','^9.', 'win7', 1, 1, 1, 1, 0, 0, 1),
('Internet Explorer 10', 'msie','^10.', 'win7', 1, 0, 0, 0, 1, 0, 1),

('Opera 11.6x', 'presto', '^2.10.', 'win7', 1, 1, 1, 1, 0, 0, 1),
('Opera 11.6x', 'presto', '^2.10.', 'osx', 1, 1, 1, 1, 0, 0, 1),
('Opera 11.6x', 'presto', '^2.10.', 'linux', 1, 1, 1, 1, 0, 0, 1),

('Safari 5.1', 'webkit', '^534.', 'win7', 1, 1, 1, 1, 0, 0, 1),
('Safari 5.1', 'webkit', '^534.', 'osx', 1, 1, 1, 1, 0, 0, 1),
('Safari 5.1', 'webkit', '^534.', 'linux', 1, 1, 1, 1, 0, 0, 1),

# Mobile Browsers

('Android 1.5/1.6', 'android', '^528.5', '*', 1, 0, 0, 0, 0, 1, 1),
('Android 2.1', 'android', '^530.17', '*', 1, 0, 0, 0, 0, 1, 1),
('Android 2.2', 'android', '^533.', '*', 1, 0, 0, 0, 0, 1, 1),
('Android 2.3', 'android', '^533.1', '*', 1, 1, 0, 0, 0, 1, 1),

('Blackberry 5', 'blackberry', '^5.0', '*', 1, 0, 0, 0, 0, 1, 1),
('Blackberry 6', 'blackberry', '^6.0', '*', 1, 1, 0, 0, 0, 1, 1),

('Firefox Mobile 4.0', 'fennec', '^4.0', '*', 1, 1, 0, 0, 0, 1, 1),

('Mobile Safari 3.1.3', 'mobilewebkit', '^528', '*', 1, 0, 0, 0, 0, 1, 1),
('Mobile Safari 3.2', 'mobilewebkit', '^531', '*', 1, 0, 0, 0, 0, 1, 1),
('Mobile Safari 4.2', 'mobilewebkit', '^533', '*', 1, 1, 0, 0, 0, 1, 1),

('Opera Mobile 10.0', 'operamobile', '^2.4.18$', '*', 1, 1, 0, 0, 0, 1, 1),

('S60 5.0', 's60', '^5.0$', '*', 1, 1, 0, 0, 0, 1, 1),

('webOS Browser 1.4', 'webos', '^1.4', '*', 1, 1, 0, 0, 0, 1, 1),
('webOS Browser 3.0', 'hpwos', '^3.0', '*',  1, 1, 0, 0, 0, 1, 1),

('Windows Mobile 7', 'winmo', '^7.', '*',  1, 1, 0, 0, 0, 1, 1);

