-- Update Journey Logo Paths for images/logos/ folder
-- Run this if you've already imported the original journey.sql data

USE theakronascension;

-- Update logo paths to point to the logos folder
UPDATE team_journey 
SET team_logo = 'images/logos/cavaliers_logo.png' 
WHERE team_name = 'Cleveland Cavaliers';

UPDATE team_journey 
SET team_logo = 'images/logos/heat_logo.png' 
WHERE team_name = 'Miami Heat';

UPDATE team_journey 
SET team_logo = 'images/logos/lakers_logo.png' 
WHERE team_name = 'Los Angeles Lakers';

-- Verify the updates
SELECT team_name, team_logo FROM team_journey ORDER BY order_sequence;